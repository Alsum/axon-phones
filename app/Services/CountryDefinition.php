<?php

namespace App\Services;

final class CountryDefinition
{
    public function __construct(
        public readonly string $name,
        public readonly string $code,
        public readonly string $prefix,
        public readonly string $regex,
    ) {}

    public function matches(string $phone): bool
    {
        return (bool) preg_match('/' . $this->regex . '/', $phone);
    }
}
