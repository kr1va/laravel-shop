<?php

namespace Domain\Order\Exceptions;

use Exception;

class PaymentProviderProcessException extends Exception
{

    public static function providerRequired(): self
    {
        return new self('Provider is required!');
    }

}
