<?php

namespace AwesomeObjects\Objects\ValueObjects;

use AwesomeObjects\Abstracts\Alphabetic;

class PaymentCardHolder extends Alphabetic
{
    protected const REGEX = '/[^a-zA-Z ]+/';
    public function __construct(string $string)
    {
        parent::__construct($string);
    }
}