<?php

namespace AwesomeObjects\Objects\ValueObjects;

use AwesomeObjects\Abstracts\Alphabetic;
use AwesomeObjects\Exceptions\PaymentCardHolderException;

class PaymentCardHolder extends Alphabetic
{
    protected const REGEX = '/[^a-zA-Z ]+/';
    public function __construct(string $cardHolder)
    {
        $cardHolder = trim($cardHolder);

        if (strlen($cardHolder) === 0) {
            throw new PaymentCardHolderException (
                'Card holder name cannot be empty'
            );
        }
        parent::__construct($cardHolder);
    }
}