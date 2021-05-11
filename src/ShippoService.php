<?php

namespace Tipoff\LaravelShippoApi;

use Shippo_Address;
use Tipoff\Support\Contracts\Services\BaseService;

class ShippoService implements BaseService
{
    /**
     * @var
     */
    private $originAddress;
    /**
     * @var
     */
    private $destinationAddress;
    /**
     * @var
     */
    private $destinationZipCodes;
    /**
     * @var
     */
    private $parcelDimensions;
    /**
     * @var
     */
    private $parcelDistanceUnit;
    /**
     * @var
     */
    private $parcelMass;
    /**
     * @var
     */
    private $parcelMassUnit;
    /**
     * @var
     */
    private $deliveryWindows;
    /**
     * @var
     */
    private $shippoApiKey;
    /**
     * @var array
     */
    private $parcels = [];
    /**
     *
     */
    const MAX_TRANSIT_TIME_DAYS = 8;

    /**
     * ShippoService constructor.
     * @param $originAddress
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getDeliveryWindows()
    {
        return $this->deliveryWindows;
    }

    /**
     * @param mixed $deliveryWindows
     */
    public function setDeliveryWindows($deliveryWindows): void
    {
        $this->deliveryWindows = $deliveryWindows;
    }

    /**
     * @param $id
     * @return \Shippo_Retrieve
     */
    public function getAddress($id)
    {
        return Shippo_Address::retrieve($id);
    }


    /**
     * @return \Shippo_All
     */
    public function getAllAddresses()
    {
        return Shippo_Address::all();
    }

    /**
     * @param string $name
     * @param string $street
     * @param string|null $zip
     * @param string|null $city
     * @param string|null $state
     * @param string $country
     * @param string|null $company
     * @param string|null $phone
     * @param string|null $email
     * @param bool $validate
     * @return Shippo_Address
     */
    public function createAddress(
        string $name,
        string $street,
        string $zip = null,
        string $city = null,
        string $state = null,
        string $country = 'US',
        string $company = null,
        string $phone = null,
        string $email = null,
        bool $validate = false
    )
    {

        $address = Shippo_Address::create([
            "name" => $name,
            "street1" => $street,
            "city" => $city,
            "zip" => $zip,
            "state" => $state,
            "country" => $country,
            "company" => $company,
            "phone" => $phone,
            "email" => $email,
            "validate" => $validate
        ]);

        if ($validate === true && !$address->validation_results->is_valid) {
            throw new \ErrorException($address->validation_results->messages[0]);
        }
        $address->id = $address->object_id;
        return $address;
    }

    /**
     * @param float $length
     * @param float $width
     * @param float $height
     * @param float $weight
     * @param string $distance_unit
     * @param string $mass_unit
     * @return \Shippo_Parcel
     */
    public function createParcel(
        float $length,
        float $width,
        float $height,
        float $weight,
        $distance_unit = "cm",
        $mass_unit = "lb")
    {
        $parcel = \Shippo_Parcel::create([
            "length" => $length,
            "width" => $width,
            "height" => $height,
            "distance_unit" => $distance_unit,
            "weight" => $weight,
            "mass_unit" => $mass_unit,
        ]);
        return $parcel;
    }

    /**
     * @param $id
     * @return \Shippo_Retrieve
     */
    public function getParcel($id)
    {
        return \Shippo_Parcel::retrieve($id);
    }

    public function getId($obj)
    {
        echo 'this:';
        var_dump($obj['object_id']);
        var_dump($obj->object_id);
        echo '/this';

        return $obj->object_id;
    }

    /**
     * @return \Shippo_All
     */
    public function getAllParcels()
    {
        return \Shippo_Parcel::all();
    }


    /**
     * @param object|string $fromAddress
     * @param object|string $toAddress
     * @param array|object|string $parcel
     * @param bool $async
     * @return mixed
     */
    public function createShipment(
        object|string $fromAddress,
        object|string $toAddress,
        array|object|string $parcel,
        bool $async = false)
    {
        $shipment = \Shippo_Shipment::create(
            [
                "address_from" => $fromAddress,
                "address_to" => $toAddress,
                "parcels" => [$parcel],
                "async" => $async,
            ]
        );

        return $shipment;
    }

    /**
     * @param $id
     * @return \Shippo_Retrieve
     */
    public function getShipment($id)
    {
        return \Shippo_Shipment::retrieve($id);
    }


    /**
     * @return \Shippo_All
     */
    public function getAllShipments()
    {
        return \Shippo_Shipment::all();
    }

    /**
     * @return mixed
     */
    public function getDestinationZipCodes()
    {
        return $this->destinationZipCodes;
    }

    /**
     * @param mixed $destinationZipCodes
     */
    public function setDestinationZipCodes($destinationZipCodes): void
    {
        $this->destinationZipCodes = $destinationZipCodes;
    }

    /**
     * @return mixed
     */
    public function getParcelDistanceUnit()
    {
        return $this->parcelDistanceUnit;
    }

    /**
     * @param mixed $parcelDistanceUnit
     */
    public function setParcelDistanceUnit($parcelDistanceUnit): void
    {
        $this->parcelDistanceUnit = $parcelDistanceUnit;
    }

    /**
     * @return mixed
     */
    public function getParcelMassUnit()
    {
        return $this->parcelMassUnit;
    }

    /**
     * @return mixed
     */
    public function getParcelMass()
    {
        return $this->parcelMass;
    }

    /**
     * @param mixed $parcelMass
     */
    public function setParcelMass($parcelMass): void
    {
        $this->parcelMass = $parcelMass;
    }

    /**
     * @param mixed $parcelMassUnit
     */
    public function setParcelMassUnit($parcelMassUnit): void
    {
        $this->parcelMassUnit = $parcelMassUnit;
    }

    /**
     * @return mixed
     */
    public function getParcelDimensions()
    {
        return $this->parcelDimensions;
    }

    /**
     * @param mixed $parcelDimensions
     */
    public function setParcelDimensions($length, $width, $height): void
    {
        $this->parcelDimensions = [
            'length' => $length,
            'width' => $width,
            'height' => $height,
            'distance_unit' => $this->getParcelDistanceUnit() ?? 'in',
            'weight' => $this->getParcelMass(),
            'mass_unit' => $this->getParcelMassUnit() ?? 'lb',
        ];
    }

    /**
     * @return mixed
     */
    public function getShippoApiKey()
    {
        return $this->shippoApiKey;
    }

    /**
     * @param mixed $shippoApiKey
     */
    public function setShippoApiKey($shippoApiKey): void
    {
        $this->shippoApiKey = $shippoApiKey;
    }


    /**
     * @return mixed
     */
    public function getOriginAddress()
    {
        return $this->originAddress;
    }

    /**
     * @param array $originAddress
     */
    public function setOriginAddress($originAddress): void
    {
        $this->originAddress = $originAddress;
    }

    /**
     * @return mixed
     */
    public function getDestinationAddress()
    {
        return $this->destinationAddress;
    }

    /**
     * @param array $destinationAddress
     */
    public function setDestinationAddress($destinationAddress): void
    {
        $this->destinationAddress = $destinationAddress;
    }

    /**
     * @return array
     */
    public function getParcels(): array
    {
        return $this->parcels;
    }

    /**
     * @param $parcels
     */
    public function setParcels($parcels): void
    {
        $this->parcels = $parcels;
    }

    /**
     * @param array $fromAddress
     * @param int $length
     * @param int $width
     * @param int $height
     * @param float $weight
     * @param string $zip
     * @param string $country
     * @return array
     */
    function getShippingSummary(array $fromAddress, int $length, int $width, int $height, float $weight, string $zip, string $country = 'US')
    {

        $toAddress = [
            'country' => $country,
            'zip' => $zip,
        ];

        $parcel = [
            'length' => $length,
            'width' => $width,
            'height' => $height,
            'distance_unit' => $this->getParcelDistanceUnit() ?? 'in',
            'weight' => $weight,
            'mass_unit' => $this->getParcelMassUnit() ?? 'lb',
        ];

        $shipments = \Shippo_Shipment::create([
            'address_from' => $this->getOriginAddress() ?? $fromAddress,
            'address_to' => $toAddress,
            'parcels' => [$parcel],
            'async' => false
        ], config('laravel-shippo-api.api_key'));
        $rates = collect($shipments['rates']);
        return [
            'minCost' => $rates->min('amount'),
            'maxCost' => $rates->max('amount'),
            'averageCost' => $rates->avg('amount'),
            'minDays' => $rates->min('estimated_days'),
            'maxDays' => $rates->max('estimated_days'),
            'providers' => join(', ', $rates->unique('provider')->pluck('provider')->toArray())
        ];
    }

    /**
     *
     */
    public function getBestValue($shipment)
    {
        return $this->findRate($shipment, "BESTVALUE");
    }


    /**
     *
     */
    public function getFastest($shipment)
    {
        return $this->findRate($shipment, "FASTEST");
    }

    /**
     *
     */
    public function getCheapest($shipment)
    {
        return $this->findRate($shipment, "CHEAPEST");
    }

    /**
     * @param $shipment
     * @return mixed
     */
    protected function findRate($shipment, $search)
    {
        foreach ($shipment['rates'] as $rates) {
            if (in_array($search, $rates['attributes'])) {
                return $rates;
            }
        }
        return "Nothing found.";
    }

    public function createTransaction($rate)
    {

        return \Shippo_Transaction::create(['rate' => $rate]);
    }
}
