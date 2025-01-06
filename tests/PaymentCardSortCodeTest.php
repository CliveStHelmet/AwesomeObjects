<?php

namespace AwesomeObjects\Test;

use AwesomeObjects\Exceptions\PaymentCardException;
use AwesomeObjects\Objects\ValueObjects\PaymentCardSortCode;
use PHPUnit\Framework\TestCase;

class PaymentCardSortCodeTest extends TestCase
{
    public function testPaymentCardSortCode_ValidString_ReturnsTrue(): void
    {
        $result = PaymentCardSortCode::validate("123456");

        $this->assertTrue($result);
    }

    public function testPaymentCardSortCode_ValidHyphenatedString_ReturnsTrue(
    ): void
    {
        $result = PaymentCardSortCode::validate("12-34-56");

        $this->assertTrue($result);
    }

    public function testPaymentCardSortCode_InvalidString_ReturnsTrue(): void
    {
        $result = PaymentCardSortCode::validate("not-a-sort-code");

        $this->assertFalse($result);
    }

    public function testPaymentCardSortCode_ShortString_ReturnsTrue(): void
    {
        $result = PaymentCardSortCode::validate("12-34-");

        $this->assertFalse($result);
    }

    public function testPaymentCardSortCode_LongString_ReturnsTrue(): void
    {
        $result = PaymentCardSortCode::validate("12-34-56-78");

        $this->assertFalse($result);
    }

    public function testPaymentCardSortCodeObject_InvalidString_ThrowsException(
    ): void
    {
        $this->expectException(PaymentCardException::class);
        $this->expectExceptionMessage('Invalid sort code: not-a-sort-code');

        new PaymentCardSortCode("not-a-sort-code");
    }

    public function testPaymentCardSortCodeObject_ShortString_ThrowsException(
    ): void
    {
        $this->expectException(PaymentCardException::class);
        $this->expectExceptionMessage('Invalid sort code: 1234');

        new PaymentCardSortCode("1234");
    }

    public function testPaymentCardSortCodeObject_LongString_ThrowsException(
    ): void
    {
        $this->expectException(PaymentCardException::class);
        $this->expectExceptionMessage('Invalid sort code: 12345678');

        new PaymentCardSortCode("12345678");
    }

    public function testPaymentCardSortCodeObject_ValidString_ReturnsSortCode(
    ): void
    {
        $sortCode = new PaymentCardSortCode("123456");

        $this->assertEquals("123456", $sortCode);
    }
}