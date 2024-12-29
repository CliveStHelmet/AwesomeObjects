<?php

declare(strict_types=1);

namespace AwesomeObjects\Objects\ValueObjects;

use AwesomeObjects\Enums\PaymentCardType;
use AwesomeObjects\Exceptions\PaymentCardVerificationException;

final class PaymentCardVerification implements \Stringable
{
    private const CARD_VERIFICATION_VALUE_DIGITS = 3;
    private const AMEX_CARD_VERIFICATION_VALUE_DIGITS = 4;
    private string $cardVerification;

    public function __construct(
        string $cardVerification,
        PaymentCardType $cardType
    ) {
        if (!self::validate($cardVerification, $cardType)) {
            throw new PaymentCardVerificationException(
                "Invalid card type '{$cardType->value}'"
            );
        }
        $this->cardVerification = $cardVerification;
    }

    public static function validate(
        string $cardVerification,
        PaymentCardType $cardType
    ): bool {
        $sortCode = preg_replace('/[^0-9]/', '', $cardVerification);

        $digits = $cardType === PaymentCardType::AMEX
            ? self::AMEX_CARD_VERIFICATION_VALUE_DIGITS
            : self::CARD_VERIFICATION_VALUE_DIGITS;

        return strlen($sortCode) === $digits;
    }

    public function __toString(): string
    {
        return $this->cardVerification;
    }
}