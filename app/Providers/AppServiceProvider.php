<?php

namespace App\Providers;

use App\Services\UserService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use WatheqAlshowaiter\BackupTables\BackupTables;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserService::class, function ($app) {
            return new UserService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Password::defaults(function () {
            return Password::min(10)
                ->mixedCase()
                ->symbols()
                ->numbers()
                ->letters()
                ->uncompromised();
        });

        BackupTables::generateBackup(['courses', 'categories', 'users', 'blogs']);
    }
}
