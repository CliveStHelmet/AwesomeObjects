<?php

use AwesomeObjects\Abstracts\Alphabetic;
use PHPUnit\Framework\TestCase;

class AlphabeticTest extends TestCase
{
    public function testAlphabetic_UpperCase_ReturnsTrue()
    {
        $this->assertTrue(Alphabetic::validate("UPPERCASE"));
    }

    public function testAlphabetic_LowerCase_ReturnsTrue()
    {
        $this->assertTrue(Alphabetic::validate("lowercase"));
    }

    public function testAlphabetic_UpperAndLowerCase_ReturnsTrue()
    {
        $this->assertTrue(Alphabetic::validate("UPPERCASElowercase"));
    }

    public function testAlphabetic_NumericCharacters_ReturnsFalse()
    {
        $this->assertFalse(Alphabetic::validate("123456789"));
    }

    public function testAlphabetic_Spaces_ReturnsFalse()
    {
        $this->assertFalse(Alphabetic::validate("A string with spaces"));
    }

    public function testAlphabetic_SpecialCharacters_ReturnsFalse()
    {
        $this->assertFalse(Alphabetic::validate("!@#$%^&*"));
    }
}