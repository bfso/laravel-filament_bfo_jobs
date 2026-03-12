<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'company_name' => 'TechNova AG',
                'email' => 'contact@technova.ch',
            ],
            [
                'company_name' => 'SwissMarketing GmbH',
                'email' => 'info@swissmarketing.ch',
            ],
            [
                'company_name' => 'BuildMaster SA',
                'email' => 'jobs@buildmaster.ch',
            ],
            [
                'company_name' => 'Helvetic IT Solutions',
                'email' => 'hr@helveticit.ch',
            ],
            [
                'company_name' => 'GreenEnergy Group',
                'email' => 'careers@greenenergy.ch',
            ],
        ];

        foreach ($companies as $company) {
            Company::query()->updateOrCreate(
                ['email' => $company['email']],
                [
                    'company_name' => $company['company_name'],
                    'password' => bcrypt('password123'),
                ]
            );
        }
    }
}
