<?php

namespace Domain\Order\Payment;

use Closure;
use Domain\Order\Contracts\PaymentGatewayContract;
use Domain\Order\Exceptions\PaymentProcessrProcessException;
use Domain\Order\Exceptions\PaymentProviderProcessException;
use Domain\Order\Models\Payment;
use Domain\Order\Models\PaymentHistory;
use Domain\Order\States\Payment\PaidPaymentState;
use Domain\Order\Traits\PaymentEvents;

class PaymentSystem
{
    use PaymentEvents;

    protected static PaymentGatewayContract $provider;

    /**
     * @throws PaymentProviderProcessException
     */
    public static function provider(PaymentGatewayContract|Closure $providerOrClosure): void
    {
        if (is_callable($providerOrClosure)) {
            $providerOrClosure = call_user_func($providerOrClosure);
        }

        if (!$providerOrClosure instanceof PaymentGatewayContract) {
            throw PaymentProviderProcessException::providerRequired();
        }

        self::$provider = $providerOrClosure;
    }

    /**
     * @throws PaymentProviderProcessException
     */
    public static function create(PaymentData $paymentData): PaymentGatewayContract
    {
        if (!self::$provider instanceof PaymentGatewayContract) {
            throw PaymentProviderProcessException::providerRequired();
        }

        Payment::query()->create([
            'payment_id' => $paymentData->id,
        ]);

        if (is_callable(self::$onCreating)) {
            $paymentData = call_user_func(self::$onCreating, $paymentData);
        }


        return self::$provider->data($paymentData);
    }

    /**
     * @throws PaymentProviderProcessException
     */
    public static function validate(): PaymentGatewayContract
    {
        if (!self::$provider instanceof PaymentGatewayContract) {
            throw PaymentProviderProcessException::providerRequired();
        }

        PaymentHistory::query()->create([
            'method' => request()->method(),
            'payload' => self::$provider->request(),
            'payment_gateway' => get_class(self::$provider)
        ]);

        if (self::$provider->validate() && self::$provider->paid()) {
            try {
                $payment = Payment::query()->where('payment_id', self::$provider->paymentId())
                    ->firstOr(function () {
                        throw PaymentProcessrProcessException::paymentNotFound();
                    });

                $payment->state->transitionTo(PaidPaymentState::class);
            } catch (PaymentProcessrProcessException $e) {
                if (is_callable(self::$onError)) {
                    call_user_func(
                        self::$onError,
                        self::$provider->errorMessage() ?? $e->getMessage()
                    );
                }
            }
        }

        return self::$provider;
    }

}
