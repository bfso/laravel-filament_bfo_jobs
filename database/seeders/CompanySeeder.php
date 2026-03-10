<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::insert([
            [
                'company_name' => 'TechNova AG',
                'email' => 'contact@technova.ch',
                'password' => bcrypt('password123'),
            ],
            [
                'company_name' => 'SwissMarketing GmbH',
                'email' => 'info@swissmarketing.ch',
                'password' => bcrypt('password123'),
            ],
            [
                'company_name' => 'BuildMaster SA',
                'email' => 'jobs@buildmaster.ch',
                'password' => bcrypt('password123'),
            ],
            [
                'company_name' => 'Helvetic IT Solutions',
                'email' => 'hr@helveticit.ch',
                'password' => bcrypt('password123'),
            ],
            [
                'company_name' => 'GreenEnergy Group',
                'email' => 'careers@greenenergy.ch',
                'password' => bcrypt('password123'),
            ],
        ]);
    }
}
