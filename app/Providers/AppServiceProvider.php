<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Banner\CostCalculator;
use Illuminate\Contracts\Foundation\Application;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CostCalculator::class, function (Application $app) {
            $config = $app->make('config')->get('banner');
            return new CostCalculator($config['price']);
        });
    }
}
