<?php

namespace AwesomeObjects\Exceptions;

use AwesomeObjects\Exceptions\InvalidPaymentCardException;

class InvalidPaymentCardSortCodeException extends InvalidPaymentCardException
{
    public function __construct(
        $message = "Sort code must be a six digit integer",
        $code = 0,
        \Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}