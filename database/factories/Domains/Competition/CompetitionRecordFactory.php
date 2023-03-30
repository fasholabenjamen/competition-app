<?php

namespace Database\Factories\Domains\Competition;

use App\Domains\Competition\Models\Competition;
use App\Domains\Competition\Models\CompetitionRecord;
use App\Domains\Identity\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class CompetitionRecordFactory extends Factory
{
    protected $model = CompetitionRecord::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create()->id,
            'competition_id' => Competition::factory()->create()->id,
            'start_time' => $this->faker->dateTime(),
            'end_time' => $this->faker->dateTime()
        ];
    }
}
