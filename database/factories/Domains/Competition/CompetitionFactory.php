<?php

namespace Database\Factories\Domains\Competition;

use App\Domains\Competition\Models\Competition;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class CompetitionFactory extends Factory
{
    protected $model = Competition::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(2)
        ];
    }
}
