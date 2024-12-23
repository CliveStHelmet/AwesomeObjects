<?php

namespace AwesomeObjects\Test;

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
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Sort code must be a six digit integer');

        new PaymentCardSortCode("not-a-sort-code");
    }

    public function testPaymentCardSortCodeObject_ShortString_ThrowsException(
    ): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Sort code must be a six digit integer');

        new PaymentCardSortCode("1234");
    }

    public function testPaymentCardSortCodeObject_LongString_ThrowsException(
    ): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Sort code must be a six digit integer');

        new PaymentCardSortCode("12345678");
    }

    public function testPaymentCardSortCodeObject_ValidString_ReturnsSortCode(
    ): void
    {
        $sortCode = new PaymentCardSortCode("123456");

        $this->assertEquals("123456", $sortCode);
    }
}