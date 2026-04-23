<?php

namespace App\Services;

final class CountryRegistry
{
    /** @var CountryDefinition[] */
    private array $countries;

    public function __construct()
    {
        $this->countries = [
            'Cameroon'   => new CountryDefinition('Cameroon',   '+237', '237', '\(237\)\ ?[2368]\d{7,8}$'),
            'Ethiopia'   => new CountryDefinition('Ethiopia',   '+251', '251', '\(251\)\ ?[1-59]\d{8}$'),
            'Morocco'    => new CountryDefinition('Morocco',    '+212', '212', '\(212\)\ ?[5-9]\d{8}$'),
            'Mozambique' => new CountryDefinition('Mozambique', '+258', '258', '\(258\)\ ?[28]\d{7,8}$'),
            'Uganda'     => new CountryDefinition('Uganda',     '+256', '256', '\(256\)\ ?\d{9}$'),
        ];
    }

    public function all(): array
    {
        return $this->countries;
    }

    public function names(): array
    {
        return array_keys($this->countries);
    }

    public function findByPhone(string $phone): ?CountryDefinition
    {
        foreach ($this->countries as $country) {
            if (str_contains($phone, '(' . $country->prefix . ')')) {
                return $country;
            }
        }
        return null;
    }
}
