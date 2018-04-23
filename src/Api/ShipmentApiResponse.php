<?php

namespace Wuunder\Api;

class ShipmentApiResponse extends ApiResponse {
    private $shipmentData;

    public function __construct($shipmentData, $error)
    {
        parent::__construct($error);
        $this->shipmentData = $shipmentData;
    }

    /**
     * Returns booking url
     *
     * @return mixed
     */
    public function getShipmentData()
    {
        return $this->shipmentData;
    }
}
