<?php

namespace AwesomeObjects\Enums;

use InvalidArgumentException;

enum PaymentCardType: string
{
    private const AMEX_REGEX = '/^3[47][0-9]{13}$/';
    private const DINERS_REGEX = '/^3(?:0[0-5]|[68][0-9])[0-9]{11}$/';
    private const DISCOVER_REGEX = '/^6(?:011|5[0-9]{2})[0-9]{12}$/';
    private const JCB_REGEX = '/^(?:2131|1800|35\d{3})\d{11}$/';
    private const MASTERCARD_REGEX = '/^5[1-5][0-9]{14}$/';
    private const VISA_REGEX = '/^4[0-9]{12}(?:[0-9]{3})?$/';
    case AMEX = 'AMEX';
    case DINERS = 'DINERS_CLUB';
    case DISCOVER = 'DISCOVER';
    case JCB = 'JCB';
    case MASTERCARD = 'MASTERCARD';
    case VISA = 'VISA';

    public static function valid(string $cardNumber): bool
    {
        if (self::issuer($cardNumber) === self::AMEX
            || self::issuer($cardNumber) === self::VISA
        ) {
            return true;
        }

        return false;
    }

    public static function issuer(string $cardNumber): self
    {
        return match (true) {
            preg_match(self::AMEX_REGEX, $cardNumber) === 1 =>
            self::AMEX,
            preg_match(self::DINERS_REGEX, $cardNumber) === 1 =>
            self::DINERS,
            preg_match(self::DISCOVER_REGEX, $cardNumber) === 1 =>
            self::DISCOVER,
            preg_match(self::JCB_REGEX, $cardNumber) === 1 =>
            self::JCB,
            preg_match(self::MASTERCARD_REGEX, $cardNumber) === 1 =>
            self::MASTERCARD,
            preg_match(self::VISA_REGEX, $cardNumber) === 1 =>
            self::VISA,
            default => throw new InvalidArgumentException()
        };
    }
}