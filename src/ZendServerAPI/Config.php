<?php
namespace ZendServerAPI;

class Config
{
    /**
     * Host for the server connection
     * @var string
     */
    protected $host = null;
    /**
     * Port for the connection
     * @var int
     */
    protected $port = '10081';
    /**
     * ApiKey for the current connection
     * @var \ZendServerAPI\ApiKey
     */
    protected $apiKey = null;

    /**
     * Construct for ZendServerAPI\Config
     */
    public function __construct()
    {

    }

    /**
     * The api key for the current connection
     *
     * @param \ZendServerAPI\ApiKey $apiKey
     */
    public function setApiKey(ApiKey $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Set the host name for the http connection
     *
     * @param string $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * Port for the connection
     *
     * @param int $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * Get the host for the connection
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Get the port
     *
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Returns the api key
     *
     * @return \ZendServerAPI\ApiKey
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }
}
