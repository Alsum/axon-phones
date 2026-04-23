<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\PhoneNumber;
use Illuminate\Pagination\LengthAwarePaginator;

final class PhoneNumberService
{
    private const PER_PAGE = 10;

    public function __construct(private readonly PhoneParser $parser) {}

    public function getPaginated(
        ?string $country,
        ?string $state,
        int     $page = 1,
    ): LengthAwarePaginator {
        $parsed = Customer::all()
            ->map(fn ($c) => $this->parser->parse($c->id, $c->name, $c->phone))
            ->filter(fn (PhoneNumber $p) => $this->matchesFilters($p, $country, $state))
            ->values();

        return new LengthAwarePaginator(
            items:       $parsed->forPage($page, self::PER_PAGE),
            total:       $parsed->count(),
            perPage:     self::PER_PAGE,
            currentPage: $page,
            options:     ['path' => request()->url(), 'query' => request()->query()],
        );
    }

    private function matchesFilters(PhoneNumber $phone, ?string $country, ?string $state): bool
    {
        if (!empty($country) && $phone->country !== $country) {
            return false;
        }

        if ($state === 'valid' && !$phone->isValid) {
            return false;
        }

        if ($state === 'invalid' && $phone->isValid) {
            return false;
        }

        return true;
    }
}
