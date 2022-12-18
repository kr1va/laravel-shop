<?php

namespace Domain\Product\Providers;

use Illuminate\Support\ServiceProvider;

//use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
    }

    public function register(): void
    {
        $this->app->register(
            ActionsServiceProvider::class
        );
    }
}
