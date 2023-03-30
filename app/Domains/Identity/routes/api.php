<?php

use App\Domains\Identity\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('identity')
    ->name('identity.')
    ->group(function() {
        Route::get('users', [UserController::class, 'index'])->name('users.index');
    });