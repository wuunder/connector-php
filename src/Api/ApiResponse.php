<?php

namespace Wuunder\Api;

class ApiResponse {

    protected $error;

    public function __construct($error)
    {
        $this->error = $error;
    }

    public function getError() {
        return $this->error;
    }
}