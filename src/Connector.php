<?php

namespace Wuunder;

use Wuunder\Api\Key;
use Wuunder\Api\Environment;
use Wuunder\Api\Endpoints\Booking;
use Wuunder\Api\Endpoints\Shipment;
use Wuunder\Api\Endpoints\Parcelshops;
use Wuunder\Api\Endpoints\Parcelshop;
use Wuunder\Util\Helper;


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

    public function setLogger($loggerClass, $loggerFunc) {
        // $this->logger = array($loggerClass, $loggerFunc);
        $helper = Helper::getInstance();
        if(empty($loggerClass)) {
            $helper->setLogger($loggerFunc);
        } else {
            $helper->setLogger(array($loggerClass, $loggerFunc));
        }
    }

    public function log() {
        $helper = Helper::getInstance();
        $helper->log("Hallo");
    }

}
