<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\Category;
use App\Models\Company;
use App\Models\Location;

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

        foreach(range(1, 20) as $i){
            Job::create([
                'company_id' => $companies->random()->id,
                'category_id' => $categories->random()->id,
                'location_id' => $locations->random()->id,
                'title' => fake('de_DE')->jobTitle(),
                'description' => fake('de_DE')->realText(400),
            ]);
        }
    }
}
