<?php

namespace App\Providers;

use App\Logo;
use App\Slider;
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
        $flogo = Logo::where('id',1)->first();
        $fslider = Slider::all();


        view()->share(
            ['flogo'=>$flogo,'fslider'=>$fslider]);
    }
}
