<?php

namespace App\Providers;

use App\Models\SystemSetting;
use Exception;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        try
        {
            $this->app->singleton('settings', function(){
                return SystemSetting::all()->first();
            });
        }
        catch(Exception $e)
        {

        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try
        {
            $settings = SystemSetting::all()->first();
            View::share('settings', $settings);
        }
        catch(Exception $e)
        {
            
        }
    }
}
