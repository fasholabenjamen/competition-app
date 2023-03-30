<?php

namespace Database\Seeders\Domains\Competition;

use App\Domains\Competition\Models\Competition;
use App\Domains\Competition\Models\CompetitionRecord;
use App\Domains\Identity\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CompetitionRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CompetitionRecord::truncate();

        $competitions = Competition::all();
        $athletes = User::all();

        #make each athlete participate in each competition
        $competitions->each(function($competition) use ($athletes) {

            $athletes->each(function($athlete) use ($competition) {
                CompetitionRecord::factory()->create([
                    'user_id' => $athlete->id,
                    'competition_id' => $competition->id,
                    'start_time' => Carbon::now(),
                    'end_time' => Carbon::now()->addSeconds(rand(10, 100)),
                ]);
            });
        });
    }
}
