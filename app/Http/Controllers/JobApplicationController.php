<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class JobApplicationController extends Controller
{
    public function applyWeb(Request $request, string $job): RedirectResponse
    {
        $application = $this->storeApplication($request, $job);

        return back()->with('status', 'Bewerbung gespeichert: '.$application['id']);
    }

    public function applyApi(Request $request, string $job): JsonResponse
    {
        $application = $this->storeApplication($request, $job);

        return response()->json([
            'message' => 'Application stored successfully.',
            'application' => $application,
        ], 201);
    }

    public function testPage(): ViewContract
    {
        $jobs = Job::query()
            ->with(['company', 'category', 'location'])
            ->latest()
            ->get();

        $featuredJob = $jobs->firstWhere('slug', 'php-developer') ?? $jobs->first();

        return view('jobs.test', [
            'jobs' => $jobs,
            'featuredJob' => $featuredJob,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function storeApplication(Request $request, string $jobRouteKey): array
    {
        $job = $this->resolveJob($jobRouteKey);
        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'cover_letter' => ['required', 'string'],
        ]);

        $user = $request->user();
        $name = $validated['name'] ?? $user?->name;
        $email = $validated['email'] ?? $user?->email;

        if (! $name || ! $email) {
            throw ValidationException::withMessages([
                'name' => 'A name is required when no authenticated user is available.',
                'email' => 'An email address is required when no authenticated user is available.',
            ]);
        }

        $jobSlug = $job->slug;
        $applicationId = (string) Str::uuid();
        $appliedAt = now()->toIso8601String();
        $fileName = sprintf(
            '%s-%s-%s.json',
            now()->format('YmdHis'),
            Str::slug($email),
            Str::lower(Str::random(8))
        );

        $application = [
            'id' => $applicationId,
            'job' => [
                'id' => $job->id,
                'title' => $job->title,
                'slug' => $jobSlug,
            ],
            'status' => 'submitted',
            'applied_at' => $appliedAt,
            'applicant' => array_filter([
                'name' => $name,
                'email' => $email,
                'phone' => $validated['phone'] ?? null,
                'user_id' => $user?->id,
            ], fn (mixed $value) => $value !== null),
            'cover_letter' => $validated['cover_letter'],
            'meta' => [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ],
        ];

        Storage::disk('local')->put(
            "job-applications/{$jobSlug}/{$fileName}",
            json_encode($application, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
        );

        return $application;
    }

    private function resolveJob(string $jobRouteKey): Job
    {
        $job = Job::query()
            ->get()
            ->first(fn (Job $candidate) => (string) $candidate->id === $jobRouteKey || $candidate->slug === $jobRouteKey);

        abort_if($job === null, 404);

        return $job;
    }
}
