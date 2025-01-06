<?php

namespace AwesomeObjects\Objects\ValueObjects;

use AwesomeObjects\Exceptions\EmailAddressException;

/**
 * Represents an email address as an immutable value object.
 *
 * This class ensures that email addresses are valid and provides a type-safe
 * representation.
 *
 * @implements \Stringable Allows the object to be used as a string.
 */
class EmailAddress implements \Stringable
{
    /**
     * @param string $email The email address
     *
     * @throws EmailAddressException If the email address is invalid.
     */
    public function __construct(protected readonly string $email)
    {
        if (!self::validate($email)) {
            throw new EmailAddressException();
        }
    }

    /**
     * Validates an email address.
     *
     * This function checks if the given string is a valid email address
     * according to the `FILTER_VALIDATE_EMAIL` filter.
     *
     * @param string $email The email address to validate.
     *
     * @return bool Returns `true` if the email address is valid, `false`
     *              otherwise.
     */
    public static function validate(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function __toString(): string
    {
        return $this->email;
    }
}