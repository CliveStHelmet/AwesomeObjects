<?php

namespace AwesomeObjects\Test;

use AwesomeObjects\Enums\PaymentCardType;
use AwesomeObjects\Objects\DataTransferObjects\PaymentCard;
use AwesomeObjects\Objects\ValueObjects\PaymentCardExpiry;
use AwesomeObjects\Objects\ValueObjects\PaymentCardHolder;
use AwesomeObjects\Objects\ValueObjects\PaymentCardNumber;
use AwesomeObjects\Objects\ValueObjects\PaymentCardSortCode;
use AwesomeObjects\Objects\ValueObjects\PaymentCardVerification;
use PHPUnit\Framework\TestCase;

class PaymentCardTest extends TestCase
{
    public function testPaymentCard_ValidDetails_ReturnsPaymentCard(): void
    {
        $date = (new \DateTimeImmutable('now'))
            ->modify('+2 years');
        $month = $date->format('m');
        $year = substr($date->format('Y'), -2);

        $paymentCard = new PaymentCard(
            cardNumber: new PaymentCardNumber('4444333322221111'),
            sortCode: new PaymentCardSortCode('12-34-56'),
            expiry: new PaymentCardExpiry($month, $year),
            verificationNumber: new PaymentCardVerification(
                '123',
                PaymentCardType::VISA
            ),
            cardHolder: new PaymentCardHolder('Mr Testy McTestface'),
        );

        $this->assertInstanceOf(PaymentCard::class, $paymentCard);
        $this->assertEquals('4444333322221111', $paymentCard->cardNumber);
        $this->assertEquals('12-34-56', $paymentCard->sortCode);
        $this->assertEquals("$month/$year", $paymentCard->expiry);
        $this->assertEquals('123', $paymentCard->verificationNumber);
        $this->assertEquals('Mr Testy McTestface', $paymentCard->cardHolder);
    }
}