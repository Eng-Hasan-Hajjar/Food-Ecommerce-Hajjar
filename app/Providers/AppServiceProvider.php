<?php

namespace App\Providers;

use App\Models\City;
use App\Models\Setting;
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
        //
        $settings  = Setting::first();
        $city = City::all();
        view()->share(with(['settings'=>$settings,'city'=>$city]));

    }
}
