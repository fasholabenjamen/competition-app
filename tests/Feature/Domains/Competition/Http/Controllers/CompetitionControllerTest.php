<?php

use App\Domains\Competition\Models\Competition;
use App\Domains\Competition\Models\CompetitionRecord;
use App\Domains\Identity\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompetitionControllerTest extends TestCase
{   
    use RefreshDatabase;

    public function test_start_competition_should_return_success_response()
    {
        $competition = Competition::factory()->create();
        $athlete = User::factory()->create();


        $url = route('competitions.start', [$competition->id, $athlete->id]);

        $response = $this->postJson($url);
        $response->assertSuccessful();

        $this->assertDatabaseHas((new CompetitionRecord())->getTable(), [
            'competition_id' => $competition->id,
            'user_id' => $athlete->id,
            'end_time' => null
        ]);
    }

    public function test_finish_competition_should_return_success_response()
    {
        $competition = Competition::factory()->create();
        $athlete = User::factory()->create();

        CompetitionRecord::factory()->create([
            'competition_id' => $competition->id,
            'user_id' => $athlete->id,
            'start_time' => now(),
            'end_time' => null
        ]);

        $url = route('competitions.finish', [$competition->id, $athlete->id]);

        $response = $this->putJson($url);

        $response->assertSuccessful();
        
        $this->assertDatabaseHas((new CompetitionRecord())->getTable(), [
            'competition_id' => $competition->id,
            'user_id' => $athlete->id
        ]);
    }

    public function test_start_competition_should_return_bad_request_response_when_athlete_has_ongoing_competition()
    {
        $competition = Competition::factory()->create();
        $athlete = User::factory()->create();

        CompetitionRecord::factory()->create([
            'user_id' => $athlete->id,
            'end_time' => null
        ]);

        $url = route('competitions.start', [$competition->id, $athlete->id]);

        $response = $this->postJson($url);
        $response->assertBadRequest();

        $this->assertDatabaseMissing((new CompetitionRecord())->getTable(), [
            'competition_id' => $competition->id,
            'user_id' => $athlete->id,
            'end_time' => null
        ]);
    }

    public function test_start_competition_should_return_bad_request_response_when_athlete_already_participated()
    {
        $competition = Competition::factory()->create();
        $athlete = User::factory()->create();

        CompetitionRecord::factory()->create([
            'user_id' => $athlete->id,
            'competition_id' => $competition->id,
        ]);

        $url = route('competitions.start', [$competition->id, $athlete->id]);

        $response = $this->postJson($url);
        $response->assertBadRequest();

        $this->assertDatabaseMissing((new CompetitionRecord())->getTable(), [
            'competition_id' => $competition->id,
            'user_id' => $athlete->id,
            'end_time' => null
        ]);
    }

    public function test_finish_competition_should_return_bad_request_response_when_athlete_has_no_ongoing_competition()
    {
        $competition = Competition::factory()->create();
        $athlete = User::factory()->create();

        $url = route('competitions.finish', [$competition->id, $athlete->id]);
        
        $response = $this->putJson($url);
        $response->assertBadRequest();
    }

    public function test_competition_leaderboard_should_return_expected_structure()
    {
        $competition = Competition::factory()->create();

        CompetitionRecord::factory(10)->create([
            'competition_id' => $competition->id,
        ]);

        $url = route('competitions.leaderboard', [$competition->id]);

        $response = $this->getJson($url)->assertSuccessful()
                        ->assertJsonStructure([
                            'results'
                        ]);

        $data = $response->json('results');
        $this->assertCount(10, $data);
        $this->assertArrayHasKey('athlete', $data[0]);
        $this->assertArrayHasKey('position', $data[0]);
        $this->assertArrayHasKey('duration', $data[0]);
    }

    public function test_competition_leaderboard_should_return_correct_position_according_to_duration()
    {
        $competition = Competition::factory()->create();
        $athlete = User::factory()->create();
        $athlete2 = User::factory()->create();
        $athlete3 = User::factory()->create();
        $athlete4 = User::factory()->create();

        $first_position_duration = 10;
        $second_position_duration = 15;
        $third_position_duration = 25;
        $fourth_position_duration = 42;

        CompetitionRecord::factory()->createMany([
            [
                'competition_id' => $competition->id,
                'user_id' => $athlete->id,
                'start_time' => now(),
                'end_time' => now()->addSeconds($fourth_position_duration)
            ],
            [
                'competition_id' => $competition->id,
                'user_id' => $athlete2->id,
                'start_time' => now(),
                'end_time' => now()->addSeconds($first_position_duration)
            ],
            [
                'competition_id' => $competition->id,
                'user_id' => $athlete3->id,
                'start_time' => now(),
                'end_time' => now()->addSeconds($second_position_duration)
            ],
            [
                'competition_id' => $competition->id,
                'user_id' => $athlete4->id,
                'start_time' => now(),
                'end_time' => now()->addSeconds($third_position_duration)
            ],

        ]);

        $url = route('competitions.leaderboard', [$competition->id]);

        $response = $this->getJson($url)->assertSuccessful()
                        ->assertJsonStructure([
                            'results'
                        ]);

        $data = $response->json('results');
        $this->assertCount(4, $data);

        $this->assertTrue($data[0]['position'] == 1);
        $this->assertTrue($data[0]['athlete'] == $athlete2->id);
        $this->assertTrue($data[0]['duration'] == number_format($first_position_duration, 1, '.', ''));
        
        $this->assertTrue($data[1]['position'] == 2);
        $this->assertTrue($data[1]['athlete'] == $athlete3->id);
        $this->assertTrue($data[1]['duration'] == number_format($second_position_duration, 1, '.', ''));
    }
}