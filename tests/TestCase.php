<?php

declare(strict_types=1);

namespace Tipoff\LaravelShippoApi\Tests;

use Laravel\Nova\NovaCoreServiceProvider;
use Tipoff\LaravelShippoApi\LaravelShippoApiServiceProvider;
use Tipoff\LaravelShippoApi\Tests\Support\Providers\NovaTestbenchServiceProvider;
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
            LaravelShippoApiServiceProvider::class,
            SupportServiceProvider::class,
            LocationsServiceProvider::class,
        ];
    }
}
