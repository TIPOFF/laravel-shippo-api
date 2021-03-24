<?php

declare(strict_types=1);

namespace Tipoff\LaravelShippoApi\Tests;

use Laravel\Nova\NovaCoreServiceProvider;
use Tipoff\Addresses\AddressesServiceProvider;
use Tipoff\Authorization\AuthorizationServiceProvider;
use Tipoff\LaravelShippoApi\LaravelShippoApiServiceProvider;
use Tipoff\Locations\LocationsServiceProvider;
use Tipoff\Support\SupportServiceProvider;
use Tipoff\TestSupport\BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            NovaCoreServiceProvider::class,
            NovaTestbenchServiceProvider::class,
            SupportServiceProvider::class,
            AuthorizationServiceProvider::class,
            AddressesServiceProvider::class,
            LocationsServiceProvider::class,
            LaravelShippoApiServiceProvider::class,
        ];
    }
}
