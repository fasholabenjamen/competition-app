<?php

namespace App\Domains\Competition\Services;

use App\Domains\Competition\Contracts\CompetitionContract;
use App\Domains\Competition\Models\Competition;
use App\Domains\Competition\Models\CompetitionRecord;
use App\Domains\Identity\Models\User;
use App\Infrastructure\Abstracts\EloquentRepository;
use Illuminate\Database\Eloquent\Collection;

class CompetitionService extends EloquentRepository implements CompetitionContract {

    public function __construct() {
        parent::__construct(new CompetitionRecord);
    }

    /**
     * Method to start an athlete for a competition
     * 
     * @param Competition $competition
     * @param User $athlete
     * @return void
     */
    public function startCompetition(Competition $competition, User $athlete): void
    {
        $is_eligible = $this->isEligible($competition, $athlete);

        abort_if(
            boolean: ! $is_eligible,
            code: 400,
            message: 'Sorry, you are not eligible to start this competition'
        );

        $this->store([
            'user_id' => $athlete->id,
            'competition_id' => $competition->id,
            'start_time' => now()
        ]);
    }

    /**
     * Method to finish a competition
     * 
     * @param Competition $competition
     * @param User $athlete
     * @return void
     */
    public function finishCompetition(Competition $competition, User $athlete): void
    {
        $has_started_competition = $this->hasStartedCompetition($competition, $athlete);

        abort_if(
            boolean: ! $has_started_competition,
            code: 400,
            message: 'Sorry, you have not start this competition'
        );

        $record = $this->getCompetitionRecord($competition, $athlete);

        $this->update($record, [
            'end_time' => now()
        ]);
    }

     /**
     * Method to check if athlete is eligible for competition
     * 
     * @param Competition $competition
     * @param User $athlete
     * @return bool
     */
    public function isEligible(Competition $competition, User $athlete): bool
    {
        if($this->hasOngoingCompetition($athlete)) return false;

        if($this->hasCompetitionRecord($competition, $athlete)) return false;

        return true;
    }

    /**
     * Method to get athlete competition record
     * 
     * @param Competition $competition
     * @param User $athlete
     * @return CompetitionRecord|null
     */
    public function getCompetitionRecord(Competition $competition, User $athlete): CompetitionRecord|null
    {
        return $this->findOneBy([
            'user_id' => $athlete->id,
            'competition_id' => $competition->id
        ]);
    }

    /**
     * Method to check if athlete has competition record
     * 
     * @param Competition $competition
     * @param User $athlete
     * @return bool
     */
    public function hasCompetitionRecord(Competition $competition, User $athlete): bool
    {
        return $this->checkBy([
            'user_id' => $athlete->id,
            'competition_id' => $competition->id
        ]);
    }

    /**
     * Method to check if athlete has started competition
     * 
     * @param Competition $competition
     * @param User $athlete
     * @return bool
     */
    public function hasStartedCompetition(Competition $competition, User $athlete): bool
    {
        return $this->model->where([
                                'user_id' => $athlete->id,
                                'competition_id' => $competition->id
                            ])
                            ->whereNotNull('start_time')
                            ->whereNull('end_time')
                            ->exists();
    }

    /**
     * Method to check if athlete has completed competition
     * 
     * @param Competition $competition
     * @param User $athlete
     * @return bool
     */
    public function hasCompletedCompetition(Competition $competition, User $athlete): bool
    {
        return $this->model->where([
                                'user_id' => $athlete->id,
                                'competition_id' => $competition->id
                            ])
                            ->whereNotNull('start_time')
                            ->whereNotNull('end_time')
                            ->exists();
    }

    /**
     * Method to check if athlete has any on-going competition
     * 
     * @param User $athlete
     * @return bool
     */
    public function hasOngoingCompetition(User $athlete): bool
    {
        return $this->model->where('user_id', $athlete->id)
                            ->whereNotNull('start_time')
                            ->whereNull('end_time')
                            ->exists();
    }

    /**
     * Method to get competition leaderboard
     * 
     * @param Competition $competition
     * @return array
     */
    public function competitionLeaderboard(Competition $competition): array
    {
        $results = $this->model->where('competition_id', $competition->id)
                            ->whereNotNull('start_time')
                            ->whereNotNull('end_time')
                            ->selectRaw('user_id as athlete, TIMESTAMPDIFF(MICROSECOND, start_time, end_time) / 1000000 as duration')
                            ->orderBy('duration')
                            ->get();

        return $this->formatLeaderboardResult($results);
    }

    /**
     * Format results to required format
     */
    private function formatLeaderboardResult(Collection $results): array
    {
        $start_position = 0;

        return $results->map(function($result) use(&$start_position) {
            $start_position += 1;
            
            return [
                'athlete' => $result->athlete,
                'position' => $start_position,
                'duration' => number_format($result->duration, 1, '.', '')
            ];
        })->toArray();
    }
} 