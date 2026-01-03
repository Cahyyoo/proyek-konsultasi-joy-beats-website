<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
    public function boot()
    {
        // Paksa HTTPS jika aplikasi diakses lewat Ngrok atau Production
        if (env('APP_ENV') !== 'local' || str_contains(request()->url(), 'ngrok-free.app') || str_contains(request()->url(), 'ngrok-free.dev')) {
            URL::forceScheme('https');
        }
    }
}
