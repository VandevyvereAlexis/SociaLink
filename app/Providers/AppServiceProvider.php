<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * 
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     * 
     * @return void 
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Carbon::setLocale('fr');
        Paginator::useBootstrap();
    }
}
