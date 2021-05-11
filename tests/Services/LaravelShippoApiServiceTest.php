<?php

namespace Tipoff\GoogleApi\Tests\Unit\Services;

use Tipoff\LaravelShippoApi\ShippoService;
use Tipoff\LaravelShippoApi\Tests\TestCase;

class GoogleServicesTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();


//        $this->googleServices = app(GoogleServices::class);

        // Because of the order in which Testbench loads things, we don't
        // have access to our .env.test variables when the config is initially
        // set. Override the config settings here so that we can test properly.
        if (file_exists(dirname(__DIR__) . '/../../.env.test')) {
            $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../../', '.env.test');
            $dotenv->load();

            config(['laravel-shippo-api' => include(realpath(__DIR__ . '/../../../config/laravel-shippo-api.php'))]);
        }
    }

    /**
     * @test
     *
     */
    public function it_creates_a_valid_address()
    {
        $shippo = new ShippoService();

        $address = $shippo->createAddress('Chris Pecoraro',
            '2445 Sherb',
            city: 'Winter P', state: 'FL', validate: true);

        $this->assertEquals($address->is_complete, true);

    }

    /**
     * @test
     *
     */
    public function it_creates_an_invalid_address()
    {
        $shippo = new ShippoService();

        $address = $shippo->createAddress('Chris Pecoraro',
            '9999 Sherbro',
            city: 'Winter P', state: 'FL', validate: true);

        $this->assertEquals($address->is_complete, false);
    }

}

