<?php

namespace Wuunder\Api;

class ParcelshopsApiResponse extends ApiResponse {

    public function __construct($header, $body, $error)
    {
        parent::__construct($header, $body, $error);
    }

    /**
     * Returns parcelshops data
     *
     * @return mixed
     */
    public function getParcelshopsData()
    {
        return $this->getBody();
    }
}