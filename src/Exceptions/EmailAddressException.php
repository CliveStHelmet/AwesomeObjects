<?php

namespace AwesomeObjects\Exceptions;

class EmailAddressException extends \InvalidArgumentException
{
    public function __construct(
        $message = "Invalid email address",
        $code = 0,
        \Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}