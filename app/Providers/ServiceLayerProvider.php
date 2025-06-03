<?php

namespace App\Providers;

use App\Contracts\JsonResponseInterface;
use App\Http\Responses\ApiResponse;
use Illuminate\Support\ServiceProvider;

class ServiceLayerProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(\App\Services\UserService::class);
        $this->app->singleton(JsonResponseInterface::class, ApiResponse::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
