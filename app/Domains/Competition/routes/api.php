<?php

use App\Domains\Competition\Http\Controllers\CompetitionController;
use Illuminate\Support\Facades\Route;

Route::prefix('competitions')
    ->name('competitions.')
    ->group(function() {
        Route::post('{competition}/athlete/{athlete}/start', [CompetitionController::class, 'startCompetition'])->name('start');
        Route::put('{competition}/athlete/{athlete}/finish', [CompetitionController::class, 'finishCompetition'])->name('finish');
        Route::get('{competition}/leaderboard', [CompetitionController::class, 'leaderboard'])->name('leaderboard');
    });