<?php

declare(strict_types=1);

namespace AwesomeObjects\Objects\ValueObjects;

use AwesomeObjects\Exceptions\PaymentCardException;
use Stringable;

final class PaymentCardSortCode implements Stringable
{
    private const SORT_CODE_LENGTH = 6;
    private readonly string $cardSortCode;

    public function __construct(string $cardSortCode)
    {
        if (!self::validate($cardSortCode)) {
            throw PaymentCardException::invalidSortCode($cardSortCode);
        }

        $this->cardSortCode = $cardSortCode;
    }

    /**
     * Checks that the sort code provided is valid.
     *
     * @param string $cardSortCode
     *
     * @return bool
     */
    public static function validate(string $cardSortCode): bool
    {
        $cardSortCode = preg_replace('/[^0-9]/', '', $cardSortCode);

        return strlen($cardSortCode) === self::SORT_CODE_LENGTH;
    }

    public function __toString(): string
    {
        return $this->cardSortCode;
    }
}