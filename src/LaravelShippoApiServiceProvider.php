<?php

declare(strict_types=1);

namespace Tipoff\LaravelShippoApi;

//use App\Console\Commands\GetRatesCommand;
use Tipoff\LaravelShippoApi\Facades\LaravelShippoApiFacade;
use ShippoApi;
use Tipoff\Support\TipoffPackage;
use Tipoff\Support\TipoffServiceProvider;

class LaravelShippoApiServiceProvider extends TipoffServiceProvider
{
    public function configureTipoffPackage(TipoffPackage $package): void
    {
        $package
            ->name('laravel-shippo-api')
            ->hasConfigFile('laravel-shippo-api');
    }

    public function register()
    {
        parent::register();

        $this->app->bind(ShippoApi::class, function () {
            \Shippo::setApiKey(config('laravel-shippo-api.api_key'));
        });
    }


}
