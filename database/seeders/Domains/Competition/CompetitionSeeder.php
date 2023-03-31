<?php

namespace Database\Seeders\Domains\Competition;

use App\Domains\Competition\Models\Competition;
use Illuminate\Database\Seeder;

class CompetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Competition::factory()->create(['id' => 'ddb8610a-cf0d-11ed-afa1-0242ac120002', 'name' => 'Swimming']);
    }
}
