<?php

namespace App\Tool\Providers;

use Illuminate\Support\ServiceProvider;
use App\Tool\ToolHelper;

class ToolServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ToolHelper::class, function () {
            return new ToolHelper();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
