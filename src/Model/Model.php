<?php

namespace Wuunder\Model;

use Wuunder\Util\Helper;

class Model
{
    private $keys;
    protected $data;
    protected static $_underscoreCache = [];

    public function __construct()
    {
        $this->keys = array();
        $this->helper = Helper::getInstance();
    }

    public function __call($method, $args)
    {
        switch (substr($method, 0, 3)) {
            case 'get' :
                $key = $this->_underscore(substr($method, 3));
                if (isset($this->data[$key])) {
                    return $this->data[$key];
                } else {
                    $this->helper->log("Unable to return data. Unknown key " . $key);
                    return null;
                }
        }
        return null;
    }

    protected function setKeys($keys) {
        $formattedKeys = array();
        foreach ($keys as $k => $v) {
            if (is_array($v)) {
                $formattedKeys[$k] = $this->formatInnerKeys($v);
            } else {
                $formattedKeys[$v] = null;
            }
        }
        $this->keys = $formattedKeys;
    }

    private function formatInnerKeys($keys) {
        $formattedKeys = array();
        foreach ($keys as $k => $v) {
            if (is_array($v)) {
                $formattedKeys[$k] = $this->formatInnerKeys($v);
            } else {
                $formattedKeys[$v] = null;
            }
        }
        return $formattedKeys;
    }

    protected function importData($data) {
        $data = json_decode($data);
        $validatedData = array();
        foreach ($data as $key => $value) {
            if (array_key_exists($key, $this->keys)) {
                if (is_array($value)) {
                    $validatedData[$key] = $this->loopInnerData($value, $this->keys[$key]);
                } else {
                    $validatedData[$key] = $value;
                }
            } else {
                throw new \Exception("Invalid data, unknown key " . $key);
            }
        }
        $this->data = $validatedData;
    }

    private function loopInnerData($data, $keysMap) {
        $validatedData = array();
        foreach ($data as $key => $value) {
            if (array_key_exists($key, $keysMap) || is_object($value)) {
                if (is_object($value)) {
                    array_push($validatedData, $this->loopInnerData($value, $this->_isAssoc($keysMap) ? $keysMap[$key] : $keysMap[0]));
                } elseif (is_array($value)) {
                    $validatedData[$key] = $this->loopInnerData($value, $keysMap[$key]);
                } else {
                    $validatedData[$key] = $value;
                }
            } else {
                throw new \Exception("Invalid data, unknown key " . $key);
            }
        }
        return $validatedData;
    }

    private function _isAssoc(array $arr)
    {
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
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
}