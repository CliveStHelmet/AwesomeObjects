<?php

namespace AwesomeObjects\Test;

use AwesomeObjects\Enums\PaymentCardType;
use AwesomeObjects\Objects\DataTransferObjects\PaymentCard;
use AwesomeObjects\Objects\ValueObjects\PaymentCardNumber;
use AwesomeObjects\Objects\ValueObjects\PaymentCardSortCode;
use AwesomeObjects\Objects\ValueObjects\PaymentCardVerification;
use PHPUnit\Framework\TestCase;

class PaymentCardTest extends TestCase
{
    public function testPaymentCard_ValidDetails_ReturnsPaymentCard(): void
    {
        $paymentCard = new PaymentCard(
            cardNumber: new PaymentCardNumber('4444333322221111'),
            sortCode: new PaymentCardSortCode('12-34-56'),
            verificationNumber: new PaymentCardVerification('123', PaymentCardType::VISA),
            cardHolder: "Mr Stephen Mitchell"
        );

        $this->assertInstanceOf(PaymentCard::class, $paymentCard);
        $this->assertEquals('4444333322221111', $paymentCard->cardNumber);
        $this->assertEquals('12-34-56', $paymentCard->sortCode);
        $this->assertEquals('123', $paymentCard->verificationNumber);
        $this->assertEquals('Mr Stephen Mitchell', $paymentCard->cardHolder);
    }
}