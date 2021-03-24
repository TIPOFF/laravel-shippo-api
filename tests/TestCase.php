<?php

declare(strict_types=1);

namespace Tipoff\LaravelShippoApi\Tests;

use Laravel\Nova\NovaCoreServiceProvider;
use Tipoff\Authorization\AuthorizationServiceProvider;
use Tipoff\LaravelShippoApi\LaravelShippoApiServiceProvider;
use Tipoff\Support\SupportServiceProvider;
use Tipoff\TestSupport\BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            NovaCoreServiceProvider::class,
            NovaPackageServiceProvider::class,
            SupportServiceProvider::class,
            AuthorizationServiceProvider::class,
            LaravelShippoApiServiceProvider::class,
        ];
    }
}
