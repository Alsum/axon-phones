<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhoneFilterRequest;
use App\Services\CountryRegistry;
use App\Services\PhoneNumberService;

class PhoneNumberController extends Controller
{
    public function __construct(
        private readonly PhoneNumberService $service,
        private readonly CountryRegistry    $registry,
    ) {}

    public function index(PhoneFilterRequest $request)
    {
        $country   = $request->country();
        $state     = $request->state();
        $page      = (int) $request->input('page', 1);

        $numbers   = $this->service->getPaginated($country, $state, $page);
        $countries = $this->registry->names();

        return view('phones.index', compact('numbers', 'countries', 'country', 'state'));
    }
}
