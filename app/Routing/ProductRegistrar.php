<?php

namespace App\Routing;

use App\Contracts\RouterRegistrar;
use App\Http\Controllers\ProductController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class ProductRegistrar implements RouterRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('web')
            ->group(function () {
                Route::get('/product/{product:slug}', ProductController::class)
                    ->name('product');
            });
    }

}
