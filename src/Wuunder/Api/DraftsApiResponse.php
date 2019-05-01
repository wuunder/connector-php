<?php

namespace Wuunder\Api;

class DraftsApiResponse extends ApiResponse {

    public function __construct($header, $body, $error)
    {
        parent::__construct($header, $body, $error);
    }
}