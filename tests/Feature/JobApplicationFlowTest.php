<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Company;
use App\Models\Job;
use App\Models\Location;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class JobApplicationFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_application_is_saved_as_json_file(): void
    {
        Storage::fake('local');

        $job = $this->createJob('PHP Developer');
        $user = User::factory()->create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
        ]);

        $response = $this->actingAs($user)->post('/jobs/php-developer/apply', [
            'cover_letter' => 'I would love to join the team.',
        ]);

        $response->assertRedirect();

        $files = Storage::disk('local')->allFiles('job-applications/php-developer');

        $this->assertCount(1, $files);

        $payload = json_decode(Storage::disk('local')->get($files[0]), true, 512, JSON_THROW_ON_ERROR);

        $this->assertSame('Jane Doe', $payload['applicant']['name']);
        $this->assertSame('jane@example.com', $payload['applicant']['email']);
        $this->assertSame($user->id, $payload['applicant']['user_id']);
        $this->assertSame('submitted', $payload['status']);
    }

    public function test_guest_application_is_saved_as_json_file(): void
    {
        Storage::fake('local');

        $this->createJob('PHP Developer');

        $response = $this->post('/jobs/php-developer/apply', [
            'name' => 'Guest Applicant',
            'email' => 'guest@example.com',
            'phone' => '+41 79 000 00 00',
            'cover_letter' => 'This is my guest application.',
        ]);

        $response->assertRedirect();

        $files = Storage::disk('local')->allFiles('job-applications/php-developer');

        $this->assertCount(1, $files);

        $payload = json_decode(Storage::disk('local')->get($files[0]), true, 512, JSON_THROW_ON_ERROR);

        $this->assertSame('Guest Applicant', $payload['applicant']['name']);
        $this->assertSame('guest@example.com', $payload['applicant']['email']);
        $this->assertSame('+41 79 000 00 00', $payload['applicant']['phone']);
    }

    public function test_api_route_stores_json_without_csrf_token(): void
    {
        Storage::fake('local');

        $this->createJob('PHP Developer');

        $response = $this->postJson('/api/jobs/php-developer/apply', [
            'name' => 'API Applicant',
            'email' => 'api@example.com',
            'cover_letter' => 'Applying via API.',
        ]);

        $response
            ->assertCreated()
            ->assertJsonPath('message', 'Application stored successfully.')
            ->assertJsonPath('application.applicant.email', 'api@example.com');

        $files = Storage::disk('local')->allFiles('job-applications/php-developer');

        $this->assertCount(1, $files);
    }

    public function test_browser_test_page_loads_successfully(): void
    {
        $response = $this->get('/jobs/test');

        $response
            ->assertOk()
            ->assertSee('Diese Seite zeigt nur die Hauptfunktionen des Projekts.')
            ->assertSee('Bewerbung absenden');
    }

    private function createJob(string $title): Job
    {
        $company = Company::create([
            'company_name' => 'Acme Inc.',
            'email' => 'company@example.com',
            'password' => bcrypt('password'),
        ]);

        $category = Category::create([
            'name' => 'Engineering',
        ]);

        $location = Location::create([
            'name' => 'Zurich',
        ]);

        return Job::create([
            'company_id' => $company->id,
            'category_id' => $category->id,
            'location_id' => $location->id,
            'title' => $title,
            'description' => 'Build great software.',
        ]);
    }
}
