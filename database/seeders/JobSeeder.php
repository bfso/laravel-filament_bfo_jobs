<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Company;
use App\Models\Job;
use App\Models\Location;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();
        $categories = Category::all();
        $locations = Location::all();

        if ($companies->isEmpty() || $categories->isEmpty() || $locations->isEmpty()) {
            return;
        }

        Job::query()->updateOrCreate(
            ['title' => 'PHP Developer'],
            [
                'company_id' => $companies->first()->id,
                'category_id' => $categories->first()->id,
                'location_id' => $locations->first()->id,
                'description' => 'Wir suchen eine PHP Developer Person fuer unseren einfachen Bewerbungs-Flow.',
            ]
        );

        foreach (range(1, 20) as $i) {
            Job::query()->firstOrCreate([
                'company_id' => $companies->random()->id,
                'category_id' => $categories->random()->id,
                'location_id' => $locations->random()->id,
                'title' => fake()->jobTitle(),
            ], [
                'description' => fake()->paragraph(5),
            ]);
        }
    }
}
