<?php

declare(strict_types=1);

namespace AwesomeObjects\Objects\DataTransferObjects;

use AwesomeObjects\Objects\ValueObjects\PaymentCardExpiry;
use AwesomeObjects\Objects\ValueObjects\PaymentCardHolder;
use AwesomeObjects\Objects\ValueObjects\PaymentCardNumber;
use AwesomeObjects\Objects\ValueObjects\PaymentCardSortCode;
use AwesomeObjects\Objects\ValueObjects\PaymentCardVerification;

/**
 * @property-read PaymentCardNumber $cardNumber
 * @property-read PaymentCardSortCode $sortCode
 * @property-read PaymentCardExpiry $expiry
 * @property-read PaymentCardVerification $verificationNumber
 * @property-read PaymentCardHolder $cardHolder
 */
final class PaymentCard
{
    public function __construct(
        public readonly PaymentCardNumber $cardNumber,
        public readonly PaymentCardSortCode $sortCode,
        public readonly PaymentCardExpiry $expiry,
        public readonly PaymentCardVerification $verificationNumber,
        public readonly PaymentCardHolder $cardHolder
    ) {
    }
}