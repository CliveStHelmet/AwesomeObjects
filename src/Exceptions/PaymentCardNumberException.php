<?php

namespace AwesomeObjects\Exceptions;

class PaymentCardNumberException extends PaymentCardException
{
    public function __construct(
        $message = "Card number must be a fifteen or sixteen digit integer",
        $code = 0,
        \Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}