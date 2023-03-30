<?php

namespace Database\Seeders;

use Database\Seeders\Domains\Competition\CompetitionRecordSeeder;
use Database\Seeders\Domains\Competition\CompetitionSeeder;
use Database\Seeders\Domains\Identity\UserSeeder;
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
        $this->call([
            UserSeeder::class,
            CompetitionSeeder::class,
            CompetitionRecordSeeder::class
        ]);
    }
}
