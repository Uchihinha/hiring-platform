<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\Company;
use App\Models\Vacancy;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $company = Company::factory()->create([
            'id' => 1
        ]);

        $vacancy = Vacancy::factory()->create([
            'company_id' => $company->id
        ]);

        Candidate::factory(3)->create([
            'vacancy_id' => $vacancy->id
        ]);

        Wallet::factory(1)->create([
            'company_id' => $company->id
        ]);
    }
}
