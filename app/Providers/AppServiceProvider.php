<?php

namespace App\Providers;

use App\Helpers\UniqueStringGenerator;
use Faker\Factory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('UniqueStringGenerator', function () {
            return new UniqueStringGenerator(Factory::create());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
