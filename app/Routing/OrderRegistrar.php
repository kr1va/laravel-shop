<?php

declare(strict_types=1);

namespace App\Routing;

use App\Contracts\RouterRegistrar;
use App\Http\Controllers\OrderController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class OrderRegistrar implements RouterRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('web')->group(function () {
            Route::middleware('web')->group(function () {
                Route::get('/order', [OrderController::class, 'index'])->name('order');
                Route::post('/order', [OrderController::class, 'handle'])->name('order.handle');
            });
        });
    }
}
