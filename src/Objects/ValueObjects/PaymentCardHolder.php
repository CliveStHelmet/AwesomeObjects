<?php

declare(strict_types=1);

namespace AwesomeObjects\Objects\ValueObjects;

use AwesomeObjects\Abstracts\Alphabetic;
use AwesomeObjects\Exceptions\PaymentCardException;

final class PaymentCardHolder extends Alphabetic
{
    protected const REGEX = '/[^a-zA-Z ]+/';
    public function __construct(string $cardHolder)
    {
        $cardHolder = trim($cardHolder);

        if (strlen($cardHolder) === 0) {
            throw PaymentCardException::invalidCardHolder($cardHolder);
        }
        parent::__construct($cardHolder);
    }
}