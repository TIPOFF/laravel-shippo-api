<?php

declare(strict_types=1);

namespace Tipoff\LaravelShippoApi;

use Tipoff\Support\TipoffPackage;
use Tipoff\Support\TipoffServiceProvider;

class LaravelShippoApiServiceProvider extends TipoffServiceProvider
{
    public function configureTipoffPackage(TipoffPackage $package): void
    {
        $package
            ->name('laravel-shippo-api')
            ->hasConfigFile();
    }
}
