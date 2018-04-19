<?php

namespace Wuunder\Http;

use Wuunder\Http\Request;

class PostRequest extends Request {

    private $postData;

    public function __construct($url, $apiKey, $data)
    {
        parent::__construct($url, $apiKey);
        $this->postData = $data;
    }

    public function send()
    {
        $cc = curl_init($this->url);

        curl_setopt($cc, CURLOPT_HTTPHEADER,
            array('Authorization: Bearer ' . $this->apiKey, 'Content-type: application/json'));
        curl_setopt($cc, CURLOPT_POST, 1);
        curl_setopt($cc, CURLOPT_POSTFIELDS, $this->postData);
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