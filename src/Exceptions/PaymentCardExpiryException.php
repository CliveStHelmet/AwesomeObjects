<?php

namespace AwesomeObjects\Exceptions;

class PaymentCardExpiryException extends PaymentCardException
{
    public function __construct(
        $message = "Invalid expiry date",
        $code = 0,
        \Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}