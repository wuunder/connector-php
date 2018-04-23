<?php
class Helper {

    public static function Instance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new Helper();
        }
        return $inst;
    }

    private function __construct()
    {
        
    }
}
