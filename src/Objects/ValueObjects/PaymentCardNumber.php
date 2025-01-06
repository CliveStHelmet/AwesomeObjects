<?php

declare(strict_types=1);

namespace AwesomeObjects\Objects\ValueObjects;

use AwesomeObjects\Enums\PaymentCardType;
use AwesomeObjects\Exceptions\PaymentCardException;
use Stringable;

final class PaymentCardNumber implements Stringable
{
    private readonly string $cardNumber;

    public function __construct(
        string $cardNumber,
    ) {
        $this->cardNumber = self::validate($cardNumber)
            ? $cardNumber
            : throw PaymentCardException::invalidCardNumber($cardNumber);
    }

    /**
     * Performs a Luhn check on a payment card number.
     *
     * @throws PaymentCardException
     */
    public static function validate(string $cardNumber): bool
    {
        if (!filter_var($cardNumber, FILTER_VALIDATE_INT)) {
            throw PaymentCardException::invalidCardNumber($cardNumber);
        }

        $checkDigit = (int)substr($cardNumber, -1);
        $number = strrev(
            substr($cardNumber, 0, strlen($cardNumber) - 1)
        );

        $sum = 0;

        for ($i = 0; $i < strlen($number); $i++) {
            $digit = (int)substr($number, $i, 1);
            if ($i % 2 === 0) {
                $digit *= 2;
                if ($digit > 9) {
                    $digit -= 9;
                }
            }
            $sum += $digit;
        }

        return $checkDigit === ($sum % 10 === 0 ? 0 : 10 - $sum % 10);
    }

    /**
     * Determines the type of payment card used.
     *
     * @param string $cardNumber
     *
     * @return PaymentCardType
     */
    public static function type(string $cardNumber): PaymentCardType
    {
        return PaymentCardType::issuer($cardNumber);
    }

    public function __toString(): string
    {
        return $this->cardNumber;
    }
}