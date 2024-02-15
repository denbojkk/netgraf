<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;

class PetServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerHttpMacros();
    }

    public function registerHttpMacros(){
        Http::macro('petsApi', function(){
            return Http::withHeaders([
                'accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])->baseUrl(config('petstore.api_url'));
        });
    }
}
