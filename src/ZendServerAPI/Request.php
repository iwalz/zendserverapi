<?php
namespace ZendServerAPI;

use Guzzle\Service\Client;

class Request
{
    /**
     * Method class for the request
     * @var \ZendServerAPI\Method
     */
    private $action = null;
    /**
     * Useragent for the request
     * @var string
     */
    private $userAgent = 'Guzzle';
    /**
     * Config for the connection
     * @var \ZendServerAPI\Config
     */
    private $config = null;
    /**
     * Client to use for real http requests
     * @var \Guzzle\Http\Client
     */
    private $client = null;

    /**
     * Constructor for the request class
     */
    public function __construct()
    {

    }

    /**
     * Set method implementation object
     *
     * @param  \ZendServerAPI\Method  $action
     * @return \ZendServerAPI\Request
     */
    public function setAction(\ZendServerAPI\Method $action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Set the user agent used by the request
     *
     * @param string $userAgent
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
    }

    /**
     * Get the used config object
     *
     * @param \ZendServerAPI\Config $config
     */
    public function setConfig(\ZendServerAPI\Config $config)
    {
        $this->config = $config;
    }

    /**
     * Return the current action object
     *
     * @return \ZendServerAPI\Method
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Returns the user agent
     *
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * Returns the currently used config
     *
     * @return \ZendServerAPI\Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Get HTTP client
     *
     * @return \Guzzle\Http\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set the client for requests
     *
     * @param \Guzzle\Http\Client $client
     */
    public function setClient(\Guzzle\Http\Client $client)
    {
        $this->client = $client;
    }

    /**
     * This method performs the real REST call
     *
     * @throws \ZendServerAPI\Exception\ClientSide
     * @throws \ZendServerAPI\Exception\ServerSide
     * @throws \Exception
     */
    public function send()
    {
        if (!$this->client) {
            $this->client = new Client(
                    'http://{host}:{port}',
                    array(
                            'host' => $this->config->getHost(),
                            'port' => $this->config->getPort())
            );
        }

        if ($this->action->getMethod() === 'GET') {
            $requests = $this->client->get($this->action->getLink());
        } elseif ($this->action->getMethod() === 'POST') {
            $content = $this->action->getContent();

            $requests = $this->client->post(
                    $this->action->getLink(),
                    array(
                            'Content-length' => strlen($content),
                            'Content-type' => $this->action->getContentType()
                    ),
                    $content
            );

        }

        $postFiles = $this->action->getPostFiles();
        if (count($postFiles) > 0) {
            foreach ($postFiles as $field => $postValue) {
                $fileName = $postValue['fileName'];
                $contentType = $postValue['contentType'];
                $requests->addPostFile($field, $fileName, $contentType);
            }
        }

        $contentValues = $this->getAction()->getContentValues();
        if (count($contentValues) > 0) {
                $requests->addPostFields($contentValues);
        }

        /**
         * @var \Guzzle\Http\Message\Request $requests
         */
        $requests->setHeader('X-Zend-Signature', $this->config->getApiKey()->getName().';'.$this->generateRequestSignature($this->getDate()));
        $requests->setHeader('Accept', $this->action->getAcceptHeader());
        $requests->setHeader('lookInCupboard', 'true');
        $requests->setHeader('Date', $this->getDate());
        $requests->setHeader('User-Agent', $this->userAgent);

        try {
            $response = $this->client->send($requests);
            $this->getAction()->setResponse($response);
        } catch (\Guzzle\Http\Exception\CurlException $exception) {
            throw $exception;
        } catch (\Guzzle\Http\Exception\BadResponseException $exception) {
            if ($exception->getResponse() !== null) {
                $statusCode = $exception->getResponse()->getStatusCode();
                if($statusCode >= 400 && $statusCode <= 499)
                    throw new Exception\ClientSide($exception->getResponse()->getBody(), $statusCode);
                elseif($statusCode >= 500 && $statusCode <= 599)
                    throw new Exception\ServerSide($exception->getResponse()->getBody(), $statusCode);
                else
                    throw new \InvalidArgumentException($exception->getResponse()->getBody(), $statusCode);
            } elseif ($exception->getMessage() !== null) {
                $statusCode = $exception->getCode();
                if($statusCode >= 400 && $statusCode <= 499)
                    throw new Exception\ClientSide($exception->getMessage(), $exception->getCode());
                elseif($statusCode >= 500 && $statusCode <= 599)
                throw new Exception\ServerSide($exception->getMessage(), $exception->getCode());
                else
                    throw new \InvalidArgumentException($exception->getMessage(), $exception->getCode());
            } else {
                throw $exception;
            }
        }

        return $this->getAction()->parseResponse();
    }

    /**
     * Get a special formatted date string, needed by the server api
     *
     * @return string
     */
    private function getDate()
    {
        $date = gmdate('D, d M Y H:i:s e');
        $date = str_replace('UTC', 'GMT', $date);

        return $date;
    }

    /**
     * Calculate the request signature used for authentification
     *
     * @param  string $date
     * @return string
     */
    private function generateRequestSignature($date)
    {
        $data = $this->config->getHost() . ":".$this->config->getPort().":" .
                $this->action->getFunctionPath() . ":" .
                $this->userAgent . ":" .
                $date;

        return hash_hmac('sha256', $data, $this->config->getApiKey()->getKey());
    }
}
