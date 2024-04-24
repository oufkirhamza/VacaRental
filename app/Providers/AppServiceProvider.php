<?php

namespace App\Providers;

use App\Models\Propertie;
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
        $properties = Propertie::all();
        view()->share(['properties'=>$properties]);
    }
}
