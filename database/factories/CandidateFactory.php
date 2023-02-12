<?php

namespace Database\Factories;

use App\Models\Candidate;
use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidate>
 */
class CandidateFactory extends Factory
{
    protected $model = Candidate::class;

    public function definition()
    {
        return [
            'vacancy_id' => fn () => Vacancy::factory()->create()->id,
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'description' => $this->faker->text,
            'strengths' => json_encode(['PHP', 'Laravel', 'Vue.js', 'TailwindCSS']),
        ];
    }
}
