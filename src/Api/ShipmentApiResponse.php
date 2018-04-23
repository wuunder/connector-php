<?php

namespace Wuunder\Api;

class ShipmentApiResponse extends ApiResponse {

    public function __construct($header, $body, $error)
    {
        parent::__construct($header, $body, $error);
    }

    /**
     * Returns booking url
     *
     * @return mixed
     */
    public function getShipmentData()
    {
        return $this->getBody();
    }
}
