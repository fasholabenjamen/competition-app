<?php

use App\Domains\Competition\Http\Controllers\CompetitionController;
use Illuminate\Support\Facades\Route;

Route::prefix('competitions')
    ->name('competitions.')
    ->group(function() {
        Route::get('{competition}/leaderboard', [CompetitionController::class, 'leaderboard'])->name('leaderboard');
    });