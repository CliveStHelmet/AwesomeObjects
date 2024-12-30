<?php

declare(strict_types=1);

namespace AwesomeObjects\Objects\ValueObjects;

use AwesomeObjects\Exceptions\PaymentCardExpiryException;
use PHPUnit\Exception;
use Stringable;

final class PaymentCardExpiry implements Stringable
{
    private const MONTH_REGEX = '/^(?:0[1-9]|1[0-2]|1[0-2]|[1-9])$/';
    private const YEAR_REGEX = '/^(?:\d{2}|\d{4})$/';
    private string $expiry;

    public function __construct(
        private readonly string|int $month,
        private readonly string|int $year
    ) {
        if (!self::validate($month, $year)) {
            throw new PaymentCardExpiryException("Payment card has expired");
        }

        $this->expiry = sprintf('%s-%s', $this->month, $this->year);
    }

    /**
     * Validates a Payment Card Expiry date.
     *
     * @param string             $month
     * @param string             $year
     * @param \DateTimeInterface $date
     *
     * @return bool
     * @throws PaymentCardExpiryException
     */
    public static function validate(
        string $month,
        string $year,
        \DateTimeInterface $date = new \DateTimeImmutable()
    ): bool {
        if (!self::validateMonth($month)) {
            throw new PaymentCardExpiryException("Invalid month");
        }

        if (!self::validateYear($year)) {
            throw new PaymentCardExpiryException("Invalid year");
        }

        try {
            $expiry = \DateTime::createFromFormat(
                'Y-m-d H:i:s',
                sprintf("%s-%s-01 23:59:59", $year, $month)
            );
            $expiry->modify("last day of this month");
        } catch (Exception $e) {
            throw new PaymentCardExpiryException();
        }

        $interval = $date->diff($expiry);

        return $interval->invert === 0;
    }

    private static function validateMonth(string $month): bool
    {
        return (bool)preg_match(self::MONTH_REGEX, $month);
    }

    private static function validateYear(string $year): bool
    {
        return (bool)preg_match(self::YEAR_REGEX, $year);
    }

    public function __toString(): string
    {
        return $this->expiry;
    }
}