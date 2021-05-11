<?php

declare(strict_types=1);

class ShippoApi
{
    public $api_key;

    public function __construct($api_key = null)
    {
        if ($api_key) {
            $this->api_key = $api_key;
        }
    }

    public function set_shippo_api_key($api_key)
    {
        $this->api_key = $api_key;
    }

    /**
     * Run a search
     */
    public function create(array $from_address, array $to_address, array $parcel, string $api_key, $async=false)
    {
        $shipments[] = \Shippo_Shipment::create([
            'address_from' => $from_address,
            'address_to' => $to_address,
            'parcels' => [$parcel],
            'async' => false
        ], "shippo_live_d8e165255da5f57f9df9363dd9a514479c62a83f");

    }
}
