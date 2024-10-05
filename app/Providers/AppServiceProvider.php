<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        // Blade::directive('vite', function ($entry) {

        //     return <<<HTML
        //     <script type="module" src="http://localhost:3000/{$entry}"></script>
        //     HTML;
        // });
    }
}
