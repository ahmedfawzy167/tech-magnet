<?php

namespace App\Providers;

use App\Models\Category;
use App\Services\UserService;
use App\Observers\CategoryObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Collection;

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
        /* Create Password Rule*/

        Password::defaults(function () {
            return Password::min(10)
                ->mixedCase()
                ->symbols()
                ->numbers()
                ->letters()
                ->uncompromised();
        });

        /* Register the Observer*/

        Category::observe(CategoryObserver::class);

        /* Prevent Lazy Loading During Production*/
        Model::preventLazyLoading($this->app->environment('production'));


        /* Macro that Helps in Calculate Average for Attribute */
        Collection::macro('averageOf', function ($attribute) {
            return $this->avg($attribute);
        });

         /* Use Locale in Some Views */
        view()->composer('*', function ($view) {
            $view->with('locale', app()->getLocale());
        });

       
    }
}
