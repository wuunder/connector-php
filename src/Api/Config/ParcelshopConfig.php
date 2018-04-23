<?php

namespace Wuunder\Api\Config;

class ParcelshopConfig extends Config
{
    public function __construct()
    {
        parent::__construct();
        $this->requiredFields = array(
            "id"
        );
    }

    /**
    * Checks if the key is set, returns it if true
    *
    * @return $setFields
    * @param $key
    */
    public function get($key)
    {
        if (!isset($this->setFields[$key]))
            return null;

        return $this->setFields[$key];
    }
}
