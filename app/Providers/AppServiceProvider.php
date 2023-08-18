<?php

namespace App\Providers;

use App\Features\Carousel;
use App\Features\CustomerQuestion;
use App\Features\Experiment;
use App\Features\FlashSale;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Pennant\Feature;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Paginator::useBootstrap();
        View::composer('layouts.app', function ($view) {
            $navbarCategories = Category::with('subCategory')->take(7)->get();
            $view->with([
                'navbarCategories' => $navbarCategories,
            ]);
        });
        // View::composer('shop.index', function ($view) {
        //     $productCategories = Category::inRandomOrder()->take(6)->get();
        //     $view->with([
        //         'productCategories' => $productCategories
        //     ]);
        // });

        Feature::define(Carousel::class);
        Feature::define(CustomerQuestion::class);
        Feature::define(Experiment::class);
        Feature::define(FlashSale::class);
    }
}
