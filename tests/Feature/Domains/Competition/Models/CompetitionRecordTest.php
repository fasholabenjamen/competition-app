<?php

namespace Tests\Feature\Domains\Competition\Models;

use App\Domains\Competition\Models\CompetitionRecord;
use Illuminate\Support\Str;
use Tests\TestCase;

class CompetitionRecordTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_model_id_is_uuid()
    {
        $competition = CompetitionRecord::factory()->create();

        $this->assertTrue(Str::isUuid($competition->id));
    }
}