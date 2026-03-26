<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()
            ->jobs()
            ->with(['company', 'category', 'location'])
            ->latest()
            ->get();
    }

    public function publicIndex(Request $request)
    {
        $query = Job::with(["company","category","location"]);

        if($request->has("category")){
            $query->whereHas("category", fn($q)=>
            $q->where("name",$request->category)
            );
        }
         if ($request->has('location')) {
            $query->whereHas('location', fn($q) =>
                $q->where('name', $request->location)
            );
         }
         if ($request->has('search')) {
            $query->where('title', 'like', '%'.$request->search.'%');
        }
        return $query->get();
    }

    public function show(Request $request, Job $job)
    {
        $company = $request->user();

        if ($company && $job->company_id === $company->id) {
            return $job->load(['company', 'category', 'location']);
        }

        return $job->load(["company","category","location"]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'required|exists:locations,id',
        ]);

        $job = Job::create([
            'company_id'  => $request->user()->id,
            ...$data,
        ]);

        return response()->json($job->load(['company', 'category', 'location']), 201);
    }

    public function update(Request $request, Job $job)
    {
        if ($job->company_id !== $request->user()->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $data = $request->validate([
            'title'       => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'category_id' => ['sometimes', Rule::exists('categories', 'id')],
            'location_id' => ['sometimes', Rule::exists('locations', 'id')],
        ]);

        $job->update($data);

        return $job->load(['company', 'category', 'location']);
    }

    public function destroy(Request $request, Job $job)
    {
        if($job->company_id !== $request->user()->id){
            return response()->json(["message"=>"Forbidden"],403);
        }
        $job->delete();

        return response()->json(null, 204);
    }
}
