<?php

namespace App\Providers;

use App\Models\PerngukuranKinerja\OpdPerjanjianKinerja;
use App\Observers\OpdPerjanjianKinerjaObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrapFive();
        OpdPerjanjianKinerja::observe(OpdPerjanjianKinerjaObserver::class);
    }
}
