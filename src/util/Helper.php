<?php

namespace Wuunder\Util;

class Helper
{

    private $logger;

    /**
    * Creates a new instance of the Helper
    *
    * @return inst
    */
    public static function getInstance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new Helper();
        }
        return $inst;
    }

    /**
    * Sets the native logger
    *
    * @param $logger Possible array with first element class reference and second element function name.
    */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }

    /**
    * Calls the log function.
    *
    * @param $logText
    */
    public function log($logText)
    {
        if(isset($this->logger)) {
            call_user_func_array($this->logger, array($logText));
        }
    }

    private function __construct()
    {

    }
}
