<?php

namespace AwesomeObjects\Exceptions;

use AwesomeObjects\Exceptions\InvalidPaymentCardException;

class InvalidPaymentCardVerificationException
    extends InvalidPaymentCardException
{
    public function __construct(
        $message = "",
        $code = 0,
        \Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}