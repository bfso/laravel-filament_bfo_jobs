<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Company;
use App\Models\Job;
use App\Models\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BackendRequirementsTest extends TestCase
{
    use RefreshDatabase;

    public function test_company_can_register_and_login_through_api(): void
    {
        $registerResponse = $this->postJson('/api/auth/register', [
            'company_name' => 'Acme SA',
            'email' => 'contact@acme.test',
            'password' => 'secret123',
        ]);

        $registerResponse
            ->assertCreated()
            ->assertJsonPath('company.company_name', 'Acme SA')
            ->assertJsonStructure(['company' => ['id', 'company_name', 'email'], 'token']);

        $loginResponse = $this->postJson('/api/auth/login', [
            'email' => 'contact@acme.test',
            'password' => 'secret123',
        ]);

        $loginResponse
            ->assertOk()
            ->assertJsonPath('company.email', 'contact@acme.test')
            ->assertJsonStructure(['company' => ['id', 'company_name', 'email'], 'token']);
    }

    public function test_authenticated_company_can_manage_categories_locations_and_jobs(): void
    {
        $token = $this->createAuthenticatedCompanyToken();

        $categoryResponse = $this->withToken($token)->postJson('/api/categories', [
            'name' => 'IT',
        ]);

        $locationResponse = $this->withToken($token)->postJson('/api/locations', [
            'name' => 'Lausanne',
        ]);

        $categoryResponse->assertCreated();
        $locationResponse->assertCreated();

        $jobResponse = $this->withToken($token)->postJson('/api/jobs', [
            'title' => 'Backend Developer',
            'description' => 'Develop and maintain APIs.',
            'category_id' => $categoryResponse->json('id'),
            'location_id' => $locationResponse->json('id'),
        ]);

        $jobResponse
            ->assertCreated()
            ->assertJsonPath('title', 'Backend Developer')
            ->assertJsonPath('category.name', 'IT')
            ->assertJsonPath('location.name', 'Lausanne');

        $jobId = $jobResponse->json('id');

        $this->withToken($token)
            ->getJson('/api/jobs')
            ->assertOk()
            ->assertJsonCount(1)
            ->assertJsonPath('0.id', $jobId);

        $this->withToken($token)
            ->putJson("/api/jobs/{$jobId}", [
                'title' => 'Senior Backend Developer',
            ])
            ->assertOk()
            ->assertJsonPath('title', 'Senior Backend Developer');

        $this->withToken($token)
            ->putJson('/api/categories/'.$categoryResponse->json('id'), [
                'name' => 'Engineering',
            ])
            ->assertOk()
            ->assertJsonPath('name', 'Engineering');

        $this->withToken($token)
            ->putJson('/api/locations/'.$locationResponse->json('id'), [
                'name' => 'Geneva',
            ])
            ->assertOk()
            ->assertJsonPath('name', 'Geneva');

        $this->withToken($token)
            ->deleteJson("/api/jobs/{$jobId}")
            ->assertNoContent();
    }

    public function test_public_api_returns_job_list_and_supports_filters(): void
    {
        $company = Company::create([
            'company_name' => 'Acme SA',
            'email' => 'company@example.com',
            'password' => bcrypt('password'),
        ]);

        $it = Category::create(['name' => 'IT']);
        $marketing = Category::create(['name' => 'Marketing']);
        $lausanne = Location::create(['name' => 'Lausanne']);
        $zurich = Location::create(['name' => 'Zurich']);

        Job::create([
            'company_id' => $company->id,
            'category_id' => $it->id,
            'location_id' => $lausanne->id,
            'title' => 'PHP Developer',
            'description' => 'API role',
        ]);

        Job::create([
            'company_id' => $company->id,
            'category_id' => $marketing->id,
            'location_id' => $zurich->id,
            'title' => 'Marketing Specialist',
            'description' => 'Campaign role',
        ]);

        $this->getJson('/api/public/jobs')
            ->assertOk()
            ->assertJsonCount(2);

        $this->getJson('/api/public/jobs?category=IT')
            ->assertOk()
            ->assertJsonCount(1)
            ->assertJsonPath('0.title', 'PHP Developer');

        $this->getJson('/api/public/jobs?location=Zurich')
            ->assertOk()
            ->assertJsonCount(1)
            ->assertJsonPath('0.title', 'Marketing Specialist');

        $this->getJson('/api/public/jobs?search=PHP')
            ->assertOk()
            ->assertJsonCount(1)
            ->assertJsonPath('0.title', 'PHP Developer');
    }

    public function test_protected_routes_require_a_company_token(): void
    {
        $this->getJson('/api/jobs')
            ->assertUnauthorized()
            ->assertJsonPath('message', 'Unauthenticated.');
    }

    private function createAuthenticatedCompanyToken(): string
    {
        $response = $this->postJson('/api/auth/register', [
            'company_name' => 'Secure Corp',
            'email' => 'secure@example.com',
            'password' => 'secret123',
        ]);

        return $response->json('token');
    }
}
