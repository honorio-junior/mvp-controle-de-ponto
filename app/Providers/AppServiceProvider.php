<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Adapters\PointRegisterInterface;
use App\Adapters\SleekDBAdapter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PointRegisterInterface::class, SleekDBAdapter::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
