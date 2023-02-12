<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vacancy>
 */
class VacancyFactory extends Factory
{
    protected $model = Vacancy::class;

    public function definition()
    {
        return [
            'company_id' => fn () => Company::factory()->create()->id,
            'title' => $this->faker->jobTitle()
        ];
    }
}
