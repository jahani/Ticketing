<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use App\{Order};


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        // Fix Error: Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes
        Schema::defaultStringLength(191);

        // Money Directive
        Blade::directive('price', function ($expression) {
            return "<?php echo (number_format($expression, 0, '.', ',') . ' IRT'); ?>";
        });

        // Cart View Composer
        view()->composer('layouts.partials.navbarCartLink', function($view) {
            $view->with('cart', Order::getCart());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
