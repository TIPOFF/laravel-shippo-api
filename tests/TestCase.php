<?php

declare(strict_types=1);

namespace Tipoff\LaravelShippoApi\Tests;

use Tipoff\Authorization\AuthorizationServiceProvider;
use Tipoff\LaravelShippoApi\LaravelShippoApiServiceProvider;
use Tipoff\LaravelShippoApi\ShippoService;
use Tipoff\Support\SupportServiceProvider;
use Tipoff\TestSupport\BaseTestCase;

class TestCase extends BaseTestCase
{

    protected function overrideApplicationProviders($app)
    {
        return [
            'Shippo_Address' => 'Shippo_Address\Facade',
        ];
    }
    protected function getPackageProviders($app)
    {
        return [
            SupportServiceProvider::class,
            LaravelShippoApiServiceProvider::class,
        ];
    }
}
