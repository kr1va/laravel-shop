<?php

namespace Domain\Catalog\Providers;

use Illuminate\Support\ServiceProvider;

//use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class CatalogServiceProvider extends ServiceProvider
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
