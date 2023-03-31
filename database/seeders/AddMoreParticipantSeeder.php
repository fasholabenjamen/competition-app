<?php

namespace Database\Seeders;

use App\Domains\Competition\Models\Competition;
use App\Domains\Identity\Models\User;
use Database\Seeders\Domains\Competition\CompetitionRecordSeeder;
use Database\Seeders\Domains\Competition\CompetitionSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class AddMoreParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();

        $this->call([
            CompetitionRecordSeeder::class]
        );
    }
}
