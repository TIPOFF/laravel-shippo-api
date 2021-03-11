<?php

declare(strict_types=1);

namespace Tipoff\LaravelShippoApi\Tests\Support\Providers;

use Tipoff\LaravelShippoApi\Nova\Competitor;
use Tipoff\LaravelShippoApi\Nova\Insight;
use Tipoff\LaravelShippoApi\Nova\Review;
use Tipoff\LaravelShippoApi\Nova\Snapshot;
use Tipoff\TestSupport\Providers\BaseNovaPackageServiceProvider;

class NovaTestbenchServiceProvider extends BaseNovaPackageServiceProvider
{
    public static array $packageResources = [
        Competitor::class,
        Insight::class,
        Review::class,
        Snapshot::class,
    ];
}
