<?php

namespace App\Providers;

use App\Http\Controllers\CartController;
use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        Paginator::useBootstrapFive();

        $menu = Menu::all();
        View::share('menu', $menu);

        $productIds = Cart::select('*')->orderBy('product_id')->get();
        $counter = count($productIds);
        View::share('counter', $counter);
    }
}
