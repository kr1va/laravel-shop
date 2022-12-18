<?php

namespace Domain\Order\Providers;

use Domain\Order\Exceptions\PaymentProviderProcessException;
use Domain\Order\Payment\Gateways\Yookassa;
use Domain\Order\Payment\PaymentData;
use Domain\Order\Payment\PaymentSystem;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }


    /**
     * @throws PaymentProviderProcessException
     */
    public function boot(): void
    {
        /*PaymentSystem::provider(function () {
            if (request()->has('unitpay')) {
                return UnitPay();
            }
            return YooKassa();
        });*/

        PaymentSystem::provider(new Yookassa());

        PaymentSystem::onCreating(function (PaymentData $paymentData) {
            return $paymentData;
        });

        PaymentSystem::onSuccess(function (PaymentData $paymentData) {
        });

        PaymentSystem::onError(function (string $message, PaymentData $paymentData) {
        });
    }

}
