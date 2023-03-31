<?php

namespace Tests\Feature\Domains\Identity\Models;

use App\Domains\Identity\Models\User;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_model_id_is_uuid()
    {
        $competition = User::factory()->create();

        $this->assertTrue(Str::isUuid($competition->id));
    }
}