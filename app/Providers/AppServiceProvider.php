<?php

namespace App\Providers;

use App\Services\AnalyticsService\Analytics;
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
        $this->app->bind('App\Services\AnalyticsService\Contracts\AnalyticsServiceInterface', 'App\Services\AnalyticsService\Analytics');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Illuminate\Support\Facades\Schema::defaultStringLength(191);

        // Declare global categories data
        $categoryData = \App\Models\Category::where('parent_id', 0)->get();
        view()->share('globalcategories', $categoryData);
    }
}
