<?php

namespace Wuunder\Util;

class Helper
{

    private $logger;
    public static function getInstance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new Helper();
        }
        return $inst;
    }

    public function setLogger($logger)
    {
        $this->logger = $logger;
    }

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
