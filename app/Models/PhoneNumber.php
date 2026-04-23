<?php

namespace App\Models;

final class PhoneNumber
{
    public function __construct(
        public readonly int    $id,
        public readonly string $customerName,
        public readonly string $rawPhone,
        public readonly string $country,
        public readonly string $countryCode,
        public readonly string $number,
        public readonly bool   $isValid,
    ) {}

    public function state(): string
    {
        return $this->isValid ? 'OK' : 'NOK';
    }
}
