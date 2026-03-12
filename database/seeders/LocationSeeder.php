<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            "Sion",
            "Lausanne",
            "Genf",
            "Zürich",
            "Bern",
            "Lugano",
            "Basel",
        ];

        foreach($locations as $name){
            Location::query()->firstOrCreate(['name' => $name]);
        }
    }
}
