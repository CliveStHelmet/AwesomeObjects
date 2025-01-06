<?php

namespace AwesomeObjects\Exceptions;

use AwesomeObjects\Enums\PaymentCardType;

class PaymentCardException extends \InvalidArgumentException
{
    public function __construct(
        $message = "",
        $code = 0,
        \Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    public static function invalidExpiryDate(
        string $month,
        string $year
    ): static {
        return new static('Invalid expiry date: '.$month.'-'.$year);
    }

    public static function invalidCardHolder(string $cardHolder): static
    {
        return new static('Invalid card holder: '.$cardHolder);
    }

    public static function invalidCardNumber(string $cardNumber): static
    {
        return new static('Invalid card number: '.$cardNumber);
    }

    public static function invalidSortCode(string $cardSortCode): static
    {
        return new static('Invalid sort code: '.$cardSortCode);
    }

    public static function invalidVerificationCode(
        string $verificationCode,
        PaymentCardType $cardType
    ): static {
        return new static(
            'Invalid verification code: '.$verificationCode
            .' for payment card: '.$cardType->value
        );
    }
}