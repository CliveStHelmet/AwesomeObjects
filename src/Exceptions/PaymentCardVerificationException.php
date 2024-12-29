<?php

namespace AwesomeObjects\Exceptions;

use AwesomeObjects\Exceptions\PaymentCardException;

class PaymentCardVerificationException
    extends PaymentCardException
{
    public function __construct(
        $message = "",
        $code = 0,
        \Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}