<?php

namespace Wuunder\Api\Config;

abstract class Config implements \JsonSerializable
{

    protected $defaultFields;
    protected $requiredFields;
    protected $setFields;

    protected static $_underscoreCache = [];

    public function __construct()
    {
        $this->defaultFields = array();
        $this->setFields = array();
    }

    public function __call($method, $args)
    {
        switch (substr($method, 0, 3)) {
            case 'set' :
                $key = $this->_underscore(substr($method, 3));
                $this->setFields[$key] = isset($args[0]) ? $args[0] : null;
                break;
        }
    }

    public function jsonSerialize()
    {
        return array_merge($this->defaultFields, $this->setFields);
    }

    public function validate()
    {
        $resultingData = array_merge($this->defaultFields, $this->setFields);
        return $this->_arrayKeysExists($this->requiredFields, $resultingData);
    }

    private function _underscore($name)
    {
        if (isset(self::$_underscoreCache[$name])) {
            return self::$_underscoreCache[$name];
        }
        $result = strtolower(preg_replace('/(.)([A-Z])/', "$1_$2", $name));
        self::$_underscoreCache[$name] = $result;
        return $result;
    }

    private function _arrayKeysExists(array $keys, array $arr)
    {
        return !array_diff_key(array_flip($keys), $arr);
    }

}