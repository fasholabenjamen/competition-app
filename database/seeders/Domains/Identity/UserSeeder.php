<?php

namespace Database\Seeders\Domains\Identity;

use App\Domains\Identity\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create(['id' => '74557280-e509-483e-bdca-d62db74bb24e']);
    }
}
