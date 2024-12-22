<?php

namespace AwesomeObjects\Test;

use AwesomeObjects\Enums\PaymentCardType;
use AwesomeObjects\Objects\ValueObjects\PaymentCardVerification;
use PHPUnit\Framework\TestCase;

class PaymentCardVerificationTest extends TestCase
{
    public function testPaymentCardVerification_ValidNumber_ReturnsTrue(): void
    {
        $result = PaymentCardVerification::validate(
            '123',
            PaymentCardType::MASTERCARD
        );

        $this->assertTrue($result);
    }

    public function testPaymentCardVerification_InvalidNumber_ReturnsFalse(
    ): void
    {
        $result = PaymentCardVerification::validate(
            '1234',
            PaymentCardType::MASTERCARD
        );

        $this->assertFalse($result);
    }

    public function testPaymentCardVerification_ValidAmex_ReturnsTrue(): void
    {
        $result = PaymentCardVerification::validate(
            '1234',
            PaymentCardType::AMEX
        );

        $this->assertTrue($result);
    }

    public function testPaymentCardVerification_InvalidAmex_ReturnsFalse(): void
    {
        $result = PaymentCardVerification::validate(
            '123',
            PaymentCardType::AMEX
        );

        $this->assertFalse($result);
    }

    public function testPaymentCardVerification_InvalidString_ReturnsFalse(
    ): void
    {
        $result = PaymentCardVerification::validate(
            'not-a-number',
            PaymentCardType::VISA
        );

        $this->assertFalse($result);
    }

    public function testPaymentCardVerificationObject_ValidNumber_ReturnsNumber(
    ): void
    {
        $result = new PaymentCardVerification('123', PaymentCardType::VISA);

        $this->assertEquals('123', $result);
    }


    public function testPaymentCardVerificationObject_InvalidNumber_ThrowsException(
    ): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid card type 'VISA'");

        new PaymentCardVerification('1234', PaymentCardType::VISA);
    }
}