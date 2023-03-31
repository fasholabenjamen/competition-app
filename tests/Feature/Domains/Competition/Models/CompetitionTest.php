<?php

namespace Tests\Feature\Domains\Competition\Models;

use App\Domains\Competition\Models\Competition;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class CompetitionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_model_id_is_uuid()
    {
        $competition = Competition::factory()->create();

        $this->assertTrue(Str::isUuid($competition->id));
    }
}