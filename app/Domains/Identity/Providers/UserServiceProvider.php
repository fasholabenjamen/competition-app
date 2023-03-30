<?php

namespace App\Domains\Identity\Providers;

use App\Domains\Identity\Contracts\UserRepository;
use App\Domains\Identity\Services\UserService;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider{
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
        app()->bind(UserRepository::class, fn () => new UserService);
    }
}