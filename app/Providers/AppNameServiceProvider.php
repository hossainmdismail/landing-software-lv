<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppNameServiceProvider extends ServiceProvider
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

        if (!App::runningInConsole() && Schema::hasTable('settings')) {
            $setting = Setting::where('id', 1)->first();
            if ($setting) {
                config(['app.name' => $setting->web_name]);
            }
        }

    }
}
