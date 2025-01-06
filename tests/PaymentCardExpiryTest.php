<?php

namespace AwesomeObjects\Test;

use AwesomeObjects\Exceptions\PaymentCardException;
use AwesomeObjects\Objects\ValueObjects\PaymentCardExpiry;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class PaymentCardExpiryTest extends TestCase
{
    public function testPaymentCardExpiry_FutureDate_ReturnsTrue(): void
    {
        $date = new \DateTimeImmutable("+ 2 years");
        $month = $date->format('m');
        $year = substr($date->format('Y'), -2);
        $expiry = PaymentCardExpiry::validate($month, $year);

        $this->assertTrue($expiry);
    }

    public function testPaymentCardExpiry_PastDate_ReturnsFalse(): void
    {
        $expiry = PaymentCardExpiry::validate('4', '20');

        $this->assertFalse($expiry);
    }

    public function testPaymentCardExpiry_MonthZero_ThrowsException(): void
    {
        $this->expectException(PaymentCardException::class);
        $this->expectExceptionMessage("Invalid expiry date: 00-99");
        PaymentCardExpiry::validate('00', '99');
    }

    public function testPaymentCardExpiry_MonthThirteen_ThrowsException(): void
    {
        $this->expectException(PaymentCardException::class);
        $this->expectExceptionMessage("Invalid expiry date: 13-99");
        PaymentCardExpiry::validate('13', '99');
    }


    public function testPaymentCardExpiry_EmptyMonth_ThrowsException(): void
    {
        $this->expectException(PaymentCardException::class);
        $this->expectExceptionMessage("Invalid expiry date: -99");
        PaymentCardExpiry::validate('', '99');
    }

    public function testPaymentCardExpiry_ShortMonth_ReturnsTrue(): void
    {
        $expiry = PaymentCardExpiry::validate('4', '99');

        $this->assertTrue($expiry);
    }

    public function testPaymentCardExpiry_LongMonth_ThrowsException(): void
    {
        $this->expectException(PaymentCardException::class);
        $this->expectExceptionMessage("Invalid expiry date: 003-99");
        PaymentCardExpiry::validate('003', '99');
    }

    public function testPaymentCardExpiry_LongFormatMonth_ThrowsException(
    ): void
    {
        $this->expectException(PaymentCardException::class);
        $this->expectExceptionMessage("Invalid expiry date: October-99");
        PaymentCardExpiry::validate('October', '99');
    }

    public function testPaymentCardExpiry_InvalidYear_ThrowsException(): void
    {
        $this->expectException(PaymentCardException::class);
        $this->expectExceptionMessage("Invalid expiry date: 01-nineteen ninety nine");
        PaymentCardExpiry::validate('01', 'nineteen ninety nine');
    }

    public function testPaymentCardExpiry_ExpiresToday_ReturnsTrue(): void
    {
        $date = new \DateTimeImmutable('now');
        $month = $date->format('m');
        $year = substr($date->format('Y'), -2);
        $expiry = PaymentCardExpiry::validate(
            $month,
            $year,
            new DateTimeImmutable('now')
        );

        $this->assertTrue($expiry);
    }

    public function testPaymentCardExpiry_ExpiredYesterday_ReturnsFalse(): void
    {
        $date = new \DateTimeImmutable('now');
        $month = $date->format('m');
        $year = substr($date->format('Y'), -2);

        $dateToTest = (new \DateTime('+1 month'))
            ->modify('first day of this month');

        $expiry = PaymentCardExpiry::validate(
            $month,
            $year,
            $dateToTest
        );

        $this->assertFalse($expiry);
    }

    public function testPaymentCardExpiry_Valid_ReturnsPaymentCardExpiry(): void
    {
        $date = (new \DateTimeImmutable('now'))
            ->modify('+2 years');
        $month = $date->format('m');
        $year = substr($date->format('Y'), -2);
        $expiry = new PaymentCardExpiry($month, $year);

        $this->assertInstanceOf(PaymentCardExpiry::class, $expiry);
        $this->assertEquals("$month/$year", $expiry);
    }


    public function testPaymentCardExpiry_Invalid_ThrowsException(): void
    {
        $date = (new \DateTimeImmutable('now'))
            ->modify('-1 year');
        $month = $date->format('m');
        $year = substr($date->format('Y'), -2);

        $this->expectException(PaymentCardException::class);
        $this->expectExceptionMessage("Invalid expiry date: 01-24");

        new PaymentCardExpiry($month, $year);
    }
}