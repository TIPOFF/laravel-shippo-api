<?php

namespace Tipoff\LaravelShippoApi\Facades;

use Illuminate\Support\Facades\Facade;
use Tipoff\LaravelShippoApi\ShippoService;

/**
 * @see \Google_Search
 */
class LaravelShippoApiFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ShippoService::class;
    }
}
