<?php

declare(strict_types=1);

namespace AwesomeObjects\Objects\ValueObjects;

use AwesomeObjects\Exceptions\PaymentCardException;
use PHPUnit\Exception;
use Stringable;

/**
 * PaymentCardExpiry
 *
 * This Value Object provides functionality to validate legitimate expiry dates
 * on payment cards.
 *
 * @package AwesomeObjects.ValueObjects
 * @author  Stephen Mitchell
 * @version 1.0
 * @licence MIT
 */
final class PaymentCardExpiry implements Stringable
{
    private const MONTH_REGEX = '/^(?:0[1-9]|1[0-2]|1[0-2]|[1-9])$/';
    private const YEAR_REGEX = '/^\d{2}$/';
    private string $expiry;

    /**
     * @param string|int $month
     * @param string|int $year
     */
    public function __construct(
        private readonly string|int $month,
        private readonly string|int $year
    ) {
        if (!self::validate($month, $year)) {
            throw PaymentCardException::invalidExpiryDate($month, $year);
        }

        $this->expiry = sprintf('%s/%s', $this->month, $this->year);
    }

    /**
     * Validates a Payment Card Expiry date.
     *
     * @param string             $month
     * @param string             $year
     * @param \DateTimeInterface $date
     *
     * @return bool
     * @throws PaymentCardException
     */
    public static function validate(
        string $month,
        string $year,
        \DateTimeInterface $date = new \DateTimeImmutable()
    ): bool {
        if (!self::validateMonth($month)) {
            throw PaymentCardException::invalidExpiryDate($month, $year);
        }

        if (!self::validateYear($year)) {
            throw PaymentCardException::invalidExpiryDate($month, $year);
        }

        $year = sprintf('20%s', $year);

        try {
            $expiry = \DateTime::createFromFormat(
                'Y-m-d H:i:s',
                sprintf("%s-%s-01 23:59:59", $year, $month)
            );
            $expiry->modify("last day of this month");
        } catch (Exception $e) {
            throw PaymentCardException::invalidExpiryDate($month, $year);
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