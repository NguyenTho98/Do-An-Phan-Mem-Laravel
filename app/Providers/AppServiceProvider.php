<?php

namespace App\Providers;

use App\Category;
use App\Coupon;
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
        $categories = Category::where('is_delete', false)->get();
        view()->share('categories', $categories);

        $coupons = Coupon::all();
        view()->share('coupons', $coupons);
    }
}
