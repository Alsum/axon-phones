<?php

namespace App\Services;

use App\Models\PhoneNumber;

final class PhoneParser
{
    public function __construct(private readonly CountryRegistry $registry) {}

    public function parse(int $id, string $customerName, string $rawPhone): PhoneNumber
    {
        $country = $this->registry->findByPhone($rawPhone);

        if ($country === null) {
            return new PhoneNumber(
                id:           $id,
                customerName: $customerName,
                rawPhone:     $rawPhone,
                country:      'Unknown',
                countryCode:  '?',
                number:       $rawPhone,
                isValid:      false,
            );
        }

        $number = trim(preg_replace('/^\(' . $country->prefix . '\)\s?/', '', $rawPhone));

        return new PhoneNumber(
            id:           $id,
            customerName: $customerName,
            rawPhone:     $rawPhone,
            country:      $country->name,
            countryCode:  $country->code,
            number:       $number,
            isValid:      $country->matches($rawPhone),
        );
    }
}
