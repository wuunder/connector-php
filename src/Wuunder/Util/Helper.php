<?php

namespace Wuunder\Util;

class Helper
{

    private $logger;
    private $translationData;

    /**
     * Creates a new instance of the Helper
     *
     * @return Helper
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
     * @param $logger callback, possible array with first element class reference and second element function name.
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
        if (isset($this->logger)) {
            call_user_func_array($this->logger, array($logText));
        }
    }

    private function __construct()
    {

    }

    /**
     * Sets data used for translations
     *
     * @param $lang
     */
    public function setTranslationLang($lang)
    {
        $translationData = array();
        $file = realpath(dirname(dirname(__FILE__)) . "/etc/lang/en-" . strtolower($lang) . ".csv");
        if (file_exists($file)) {
            if (($handle = fopen($file, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    if (count($data) == 2) {
                        $translationData[$data[0]] = $data[1];
                    }
                }
                fclose($handle);
            }

        }
    }

    public function translate($val)
    {
//        if
    }
}
