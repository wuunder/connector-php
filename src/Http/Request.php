<?php

namespace Wuunder\Http;

abstract class Request {

    protected $url;
    protected $apiKey;
    protected $result;


    public function __construct($url, $apiKey)
    {
        $this->url = $url;
        $this->apiKey = $apiKey;
    }

    abstract protected function send();

    public function getResponse() {
        return $this->result;
    }

    public function getBody() {
        return substr($this->result, strpos($this->result, "\r\n\r\n"));
    }

    public function getResponseHeaders()
    {
        $headers = array();

        $header_text = substr($this->result, 0, strpos($this->result, "\r\n\r\n"));

        foreach (explode("\r\n", $header_text) as $i => $line)
            if ($i === 0)
                $headers['http_code'] = $line;
            else
            {
                list ($key, $value) = explode(': ', $line);

                $headers[$key] = $value;
            }

        return $headers;
    }
}