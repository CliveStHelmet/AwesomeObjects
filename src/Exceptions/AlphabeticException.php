<?php

namespace AwesomeObjects\Exceptions;

class AlphabeticException extends \InvalidArgumentException
{
    public function __construct(
        $message = "The string provided is not alphabetic.",
        $code = 0,
        \Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}