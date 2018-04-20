<?php

namespace Wuunder\Http;

use Wuunder\Http\Request;

class GetRequest extends Request {

    public function __construct($url, $apiKey)
    {
        parent::__construct($url, $apiKey);
    }

    public function send()
    {
        $cc = curl_init($this->url);

        curl_setopt($cc, CURLOPT_HTTPHEADER,
            array('Authorization: Bearer ' . $this->apiKey, 'Content-type: application/json'));
        curl_setopt($cc, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cc, CURLOPT_VERBOSE, 0);
        curl_setopt($cc, CURLOPT_HEADER, 1);

        // Execute the cURL, fetch the XML
        $result = curl_exec($cc);
        $this->result = $result;

        // Close connection
        curl_close($cc);
    }
}