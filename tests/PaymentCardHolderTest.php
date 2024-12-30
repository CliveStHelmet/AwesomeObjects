<?php

namespace AwesomeObjects\Test;

use AwesomeObjects\Exceptions\AlphabeticException;
use AwesomeObjects\Objects\ValueObjects\PaymentCardHolder;
use PHPUnit\Framework\TestCase;

class PaymentCardHolderTest extends TestCase
{
    public function testPaymentCardHolder_ValidCardHolder_ReturnsString()
    {
        $cardholder = new PaymentCardHolder("Mr Testy McTestface");
        $this->assertInstanceOf(PaymentCardHolder::class, $cardholder);
        $this->assertEquals("Mr Testy McTestface", $cardholder);
    }

    public function testPaymentCardHolder_InvalidCardHolder_ThrowsException()
    {
        $this->expectException(AlphabeticException::class);
        $this->expectExceptionMessage("The string provided is not alphabetic");

        new PaymentCardHolder("Mr_Testy_McTestface");
    }
}