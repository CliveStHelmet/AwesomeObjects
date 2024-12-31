<?php

use AwesomeObjects\Exceptions\EmailAddressException;
use AwesomeObjects\Objects\ValueObjects\EmailAddress;
use PHPUnit\Framework\TestCase;

class EmailAddressTest extends TestCase
{
    public function testEmailAddress_ValidEmailAddress(): void
    {
        $emailAddress = new EmailAddress("testy@testymctestface.com");

        $this->assertInstanceOf(EmailAddress::class, $emailAddress);
        $this->assertEquals('testy@testymctestface.com', $emailAddress);
    }

    public function testEmailAddress_InvalidEmailAddress_ThrowsException(): void
    {
        $this->expectException(EmailAddressException::class);
        $this->expectExceptionMessage("Invalid email address");

        new EmailAddress("testy");
    }

    public function testEmailAddress_InvalidEmailAddress_FailsValidation(): void
    {
        $result = EmailAddress::validate("testy@testy|mctestface.com");

        $this->assertFalse($result);
    }
}