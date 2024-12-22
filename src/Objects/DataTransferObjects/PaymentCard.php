<?php

declare(strict_types=1);

namespace AwesomeObjects\Objects\DataTransferObjects;

use AwesomeObjects\Objects\ValueObjects\PaymentCardNumber;
use AwesomeObjects\Objects\ValueObjects\PaymentCardSortCode;
use AwesomeObjects\Objects\ValueObjects\PaymentCardVerification;
use InvalidArgumentException;

final class PaymentCard
{
    public readonly string $cardHolder;

    public function __construct(
        public readonly PaymentCardNumber $cardNumber,
        public readonly PaymentCardSortCode $sortCode,
        public readonly PaymentCardVerification $verificationNumber,
        string $cardHolder
    ) {
        $cardHolder = trim($cardHolder);

        if (strlen($cardHolder) === 0) {
            throw new InvalidArgumentException(
                'Card holder name cannot be empty'
            );
        }
        $this->cardHolder = $cardHolder;
    }
}