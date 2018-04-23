<?php

namespace Wuunder\Api;

class ParcelshopApiResponse extends ApiResponse {

    public function __construct($header, $body, $error)
    {
        parent::__construct($header, $body, $error);
    }

    /**
     * Returns parcelshop data
     *
     * @return mixed
     */
    public function getParcelshopData()
    {
        return $this->getBody();
    }
}