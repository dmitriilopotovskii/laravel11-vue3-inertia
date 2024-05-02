<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;

/**
 * @method tap($scope)
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Builder::macro('filter', function (...$scopes): Builder {
            collect($scopes)->each(function ($scope) {
                $this->tap($scope);
            });

            return $this;
        });
    }
}
