<?php

namespace App\Providers;

use App\Interfaces\API\V1\FoodInterface;
use App\Services\API\V1\FoodService;
use Illuminate\Support\ServiceProvider;

class FoodServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        return $this->app->bind(FoodInterface::class, FoodService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
