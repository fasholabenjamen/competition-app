<?php

namespace App\Domains\Competition\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\Http\Controllers\Controller;
use App\Domains\Competition\Contracts\CompetitionContract;
use App\Domains\Competition\Models\Competition;
use App\Domains\Identity\Models\User;
use Illuminate\Http\JsonResponse;

class CompetitionController extends Controller {

    public function __construct(protected CompetitionContract $service) {}

    /**
     * @param Request $request
     * @param Competition $competition
     * @param User $athlete
     * @return JsonResponse
     */
    public function startCompetition(Request $request, Competition $competition, User $athlete): JsonResponse
    {
        $this->service->startCompetition($competition, $athlete);

        return response()->json(status: 200);
    }

    /**
     * @param Request $request
     * @param Competition $competition
     * @param User $athlete
     * @return JsonResponse
     */
    public function finishCompetition(Request $request, Competition $competition, User $athlete): JsonResponse
    {
        $this->service->finishCompetition($competition, $athlete);

        return response()->json(status: 200);
    }

    /**
     * @param Request $request
     * @param Competition $competition
     * @return JsonResponse
     */
    public function leaderboard(Request $request, Competition $competition)
    {
        $data = $this->service->competitionLeaderboard($competition);

        return response()->json(data: [
            'results' => $data
        ], status: 200);
    }
}