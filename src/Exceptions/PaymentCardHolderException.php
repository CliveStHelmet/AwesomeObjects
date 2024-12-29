<?php

namespace AwesomeObjects\Exceptions;

class PaymentCardHolderException extends PaymentCardException
{
    public function __construct(
        $message = "Card holder must be comprised of letters and spaces only",
        $code = 0,
        \Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}