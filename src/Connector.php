<?php

namespace Wuunder;

use Wuunder\Api\Booking;
use Wuunder\Api\Key;
use Wuunder\Api\Environment;
use Wuunder\Api\Shipment;

class Connector
{

    private $apiKey;
    private $apiEnvironment;
    private $logger; // Should become singleton

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

    public function setLogger($loggerClass, $loggerFunc) {
        $this->logger = array($loggerClass, $loggerFunc);
    }

    public function log() {
        call_user_func_array($this->logger, array("This is the log function"));
    }

}
