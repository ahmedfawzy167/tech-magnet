<?php

namespace App\Providers;

use App\Models\Category;
use App\Services\UserService;
use App\Observers\CategoryObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

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

        Category::observe(CategoryObserver::class);

        Model::preventLazyLoading($this->app->environment('production'));
    }
}
