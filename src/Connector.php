<?php

namespace Wuunder;

use Wuunder\Api\Key;
use Wuunder\Api\Environment;
use Wuunder\Api\Endpoints\Booking;
use Wuunder\Api\Endpoints\Shipment;
use Wuunder\Api\Endpoints\Parcelshops;
use Wuunder\Api\Endpoints\Parcelshop;

class Connector
{

    private $apiKey;
    private $apiEnvironment;

    public function __construct($apiKey, $isStaging = true)
    {
        $this->apiKey = new Key($apiKey);
        $this->apiEnvironment = new Environment($isStaging ? "staging" : "production");
    }

    /**
     * Creates a new Booking
     *
     * @return Booking
     */
    public function createBooking() {
        return new Booking($this->apiKey, $this->apiEnvironment);
    }

    /**
     * Creates a new Shipment
     *
     * @return Shipment
     */
    public function createShipment() {
        return new Shipment($this->apiKey, $this->apiEnvironment);
    }

    /**
     * Creates a new Parcelshops
     *
     * @return Parcelshops
     */
    public function getParcelshopsByAddress() {
        return new Parcelshops($this->apiKey, $this->apiEnvironment);
    }

    public function getParcelshopById() {
        return new Parcelshop($this->apiKey, $this->apiEnvironment);
    }


}
