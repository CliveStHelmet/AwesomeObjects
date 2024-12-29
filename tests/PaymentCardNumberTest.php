<?php

namespace AwesomeObjects\Test;

use AwesomeObjects\Enums\PaymentCardType;
use AwesomeObjects\Exceptions\PaymentCardNumberException;
use AwesomeObjects\Objects\ValueObjects\PaymentCardNumber;
use PHPUnit\Framework\TestCase;

class PaymentCardNumberTest extends TestCase
{
    public function testPaymentCardNumberValidate_ValidNumber_ReturnsTrue(
    ): void
    {
        $result = PaymentCardNumber::validate('4444333322221111');

        $this->assertTrue($result);
    }

    public function testPaymentCardNumberValidate_InvalidNumber_ReturnsFalse(
    ): void
    {
        $result = PaymentCardNumber::validate('1234123412341234');

        $this->assertFalse($result);
    }

    public function testPaymentCardNumberObject_ValidNumber_ReturnsTrue(): void
    {
        $expected = '4242424242424242';
        $result = new PaymentCardNumber('4242424242424242');

        $this->assertEquals($expected, $result);
    }

    public function testPaymentCardNumberObject_InvalidNumber_ExpectInvalidArgumentException(
    ): void
    {
        $this->expectException(PaymentCardNumberException::class);
        $this->expectExceptionMessage(
            "Card number must be a fifteen or sixteen digit integer"
        );

        new PaymentCardNumber('4321432143214321');
    }

    public function testPaymentCardNumberType_AmericanExpressCard_ReturnsTrue(
    ): void
    {
        $cardNumber = new PaymentCardNumber('343434343434343');
        $result = PaymentCardNumber::type($cardNumber);

        $this->assertSame(PaymentCardType::AMEX, $result);
    }

    public function testPaymentCardNumberType_DinersClubCard_ReturnsTrue(): void
    {
        $cardNumber = new PaymentCardNumber('36700102000000');
        $result = PaymentCardNumber::type($cardNumber);

        $this->assertSame(PaymentCardType::DINERS, $result);
    }

    public function testPaymentCardNumberType_DiscoverCard_ReturnsTrue(): void
    {
        $cardNumber = new PaymentCardNumber('6011000400000000');
        $result = PaymentCardNumber::type($cardNumber);

        $this->assertSame(PaymentCardType::DISCOVER, $result);
    }

    public function testPaymentCardNumberType_JCBCard_ReturnsTrue(): void
    {
        $cardNumber = new PaymentCardNumber('3528000700000000');
        $result = PaymentCardNumber::type($cardNumber);

        $this->assertSame(PaymentCardType::JCB, $result);
    }

    public function testPaymentCardNumberType_MasterCard_ReturnsTrue(): void
    {
        $cardNumber = new PaymentCardNumber('5454545454545454');
        $result = PaymentCardNumber::type($cardNumber);

        $this->assertSame(PaymentCardType::MASTERCARD, $result);
    }

    public function testPaymentCardNumberType_Visa_ReturnsTrue(): void
    {
        $cardNumber = new PaymentCardNumber('4444333322221111');
        $result = PaymentCardNumber::type($cardNumber);

        $this->assertSame(PaymentCardType::VISA, $result);
    }
}