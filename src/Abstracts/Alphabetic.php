<?php

declare(strict_types=1);

namespace AwesomeObjects\Abstracts;

use AwesomeObjects\Exceptions\AlphabeticException;
use Stringable;

abstract class Alphabetic implements Stringable
{
    protected const REGEX = '/[^a-zA-Z]+/';

    public function __construct(protected readonly string $string)
    {
        if (!self::validate($this->string)) {
            throw new AlphabeticException();
        }
    }

    public static function validate(string $string): bool
    {
        $matches = [];
        preg_match(static::REGEX, $string, $matches);

        return ! count($matches) > 0;
    }

    public function __toString(): string
    {
        return $this->string;
    }
}