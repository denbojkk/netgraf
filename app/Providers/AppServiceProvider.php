<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

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
        Http::globalRequestMiddleware(fn ($request) => $request->withHeader(
            'accept', 'application/json'
        ));

        Http::globalRequestMiddleware(fn ($request) => $request->withHeader(
            'Content-Type', 'application/json'
        ));
    }
}
