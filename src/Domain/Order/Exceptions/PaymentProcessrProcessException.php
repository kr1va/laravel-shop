<?php

namespace Domain\Order\Exceptions;

use Exception;

class PaymentProcessrProcessException extends Exception
{

    public static function paymentNotFound(): self
    {
        return new self('Payment not found!');
    }

}
