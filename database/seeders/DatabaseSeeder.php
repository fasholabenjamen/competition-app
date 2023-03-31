<?php

namespace Database\Seeders;

use App\Domains\Competition\Models\Competition;
use App\Domains\Competition\Models\CompetitionRecord;
use App\Domains\Identity\Models\User;
use Database\Seeders\Domains\Competition\CompetitionRecordSeeder;
use Database\Seeders\Domains\Competition\CompetitionSeeder;
use Database\Seeders\Domains\Identity\UserSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Empty tables
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Competition::truncate();
        CompetitionRecord::truncate();
        Schema::enableForeignKeyConstraints();

        $this->call([
            UserSeeder::class,
            CompetitionSeeder::class
        ]);
    }
}
