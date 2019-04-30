<?php

namespace Wuunder\Api\Endpoints;

use Wuunder\Api\BookingApiResponse;
use Wuunder\Api\Config\BookingConfig;
use Wuunder\Api\Config\DraftConfig;
use Wuunder\Api\DraftsApiResponse;
use Wuunder\Api\Environment;
use Wuunder\Api\Key;
use Wuunder\Http\PostRequest;
use Wuunder\Util\Helper;

class Drafts
{
    private $config;
    private $apiKey;
    private $apiEnvironment;
    private $draftsResponse;
    private $logger;

    public function __construct(Key $apiKey, Environment $apiEnvironment)
    {
        $this->config = new DraftConfig();
        $this->apiKey = $apiKey;
        $this->apiEnvironment = $apiEnvironment;
        $this->logger = Helper::getInstance();
    }

    /**
     * Set data to send to API
     *
     * @param DraftConfig $config
     * @internal param mixed $data JSON encoded
     */
    public function setConfig(DraftConfig $config)
    {
        $this->config = $config;
    }

    /**
     * Return BookingConfig object of current booking
     *
     * @return DraftConfig
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Fires the request and handles the result.
     *
     * @return bool
     */
    public function fire()
    {
        $bookingRequest = new PostRequest($this->apiEnvironment->getStageBaseUrl() . "/drafts",
            $this->apiKey->getApiKey(), json_encode($this->config->getDrafts()));
        try {
            $bookingRequest->send();
        } catch(Exception $e) {
            $this->logger->log($e);
        }

        $body = null;
        $header = null;
        $error = null;

        if (isset($bookingRequest->getResponseHeaders()["location"])) {
            $header = $bookingRequest->getResponseHeaders();
        } else {
            $error = $bookingRequest->getResponse();
        }
        $this->draftsResponse = new DraftsApiResponse($header, $body, $error);

        return is_null($error);
    }

    /**
     * Returns drafts response object
     *
     * @return mixed
     */
    public function getDraftsResponse()
    {
        return $this->draftsResponse;
    }
}
