<?php

namespace App\Providers;

use App\Models\Center;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
    public function boot()
    {
        view()->composer('components.navbar', function ($view) {
            $centers = [];
            if (Auth::check() && Auth::user()->role == "equip_directiu") {
                $centers = Center::all();
            }
            $view->with("selectable_centers", $centers);
        });
    }
}
