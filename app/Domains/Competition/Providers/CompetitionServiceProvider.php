<?php

namespace App\Domains\Competition\Providers;

use App\Domains\Competition\Contracts\CompetitionContract;
use App\Domains\Competition\Services\CompetitionService;
use Illuminate\Support\ServiceProvider;

class CompetitionServiceProvider extends ServiceProvider{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        app()->bind(CompetitionContract::class, fn () => new CompetitionService);
    }
}