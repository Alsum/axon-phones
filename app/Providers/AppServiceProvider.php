<?php

namespace App\Providers;

use App\Services\CountryRegistry;
use App\Services\PhoneParser;
use App\Services\PhoneNumberService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CountryRegistry::class);
        $this->app->singleton(PhoneParser::class);
        $this->app->singleton(PhoneNumberService::class);
    }

    public function boot(): void {}
}
