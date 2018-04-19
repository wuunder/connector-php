<?php

namespace Wuunder\Api;

class BookingApiResponse extends ApiResponse {
    private $bookingUrl;

    public function __construct($bookingUrl, $error)
    {
        parent::__construct($error);
        $this->bookingUrl = $bookingUrl;
    }

    /**
     * Returns booking url
     *
     * @return mixed
     */
    public function getBookingUrl()
    {
        return $this->bookingUrl;
    }
}