<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
<<<<<<< HEAD
use Illuminate\Pagination\Paginator;
    
=======
use Illuminate\Support\Facades\View;
use App\Models\Category;


>>>>>>> Giao-Dien-User

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
<<<<<<< HEAD
        Paginator::useBootstrap();
=======
        View::composer('*', function ($view) {
            $view->with('categories', Category::all());
        });
>>>>>>> Giao-Dien-User
    }
   
}



