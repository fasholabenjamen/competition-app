<?php

namespace App\Domains\Competition\Contracts;

use App\Domains\Competition\Models\Competition;
use App\Domains\Competition\Models\CompetitionRecord;
use App\Domains\Identity\Models\User;
use App\Infrastructure\Contracts\BaseRepository;

interface CompetitionContract extends BaseRepository
{
    /**
     * Method to start an athlete for a competition
     * 
     * @param Competition $competition
     * @param User $athlete
     * @return void
     */
    public function startCompetition(Competition $competition, User $athlete): void;

    /**
     * Method to finish a competition
     * 
     * @param Competition $competition
     * @param User $athlete
     * @return void
     */
    public function finishCompetition(Competition $competition, User $athlete): void;

    /**
     * Method to check if athlete is eligible for competition
     * 
     * @param Competition $competition
     * @param User $athlete
     * @return bool
     */
    public function isEligible(Competition $competition, User $athlete): bool;

    /**
     * Method to get athlete competition record
     * 
     * @param Competition $competition
     * @param User $athlete
     * @return CompetitionRecord|null
     */
    public function getCompetitionRecord(Competition $competition, User $athlete): CompetitionRecord|null;

    /**
     * Method to check if athlete has competition record
     * 
     * @param Competition $competition
     * @param User $athlete
     * @return bool
     */
    public function hasCompetitionRecord(Competition $competition, User $athlete): bool;

     /**
     * Method to check if athlete has started competition
     * 
     * @param Competition $competition
     * @param User $athlete
     * @return bool
     */
    public function hasStartedCompetition(Competition $competition, User $athlete): bool;

    /**
     * Method to check if athlete has completed competition
     * 
     * @param Competition $competition
     * @param User $athlete
     * @return bool
     */
    public function hasCompletedCompetition(Competition $competition, User $athlete): bool;

    /**
     * Method to check if athlete has any on-going competition
     * 
     * @param User $athlete
     * @return bool
     */
    public function hasOngoingCompetition(User $athlete): bool;

    /**
     * Method to get competition leaderboard
     * 
     * @param Competition $competition
     * @return 
     */
    public function competitionLeaderboard(Competition $competition): array;
}