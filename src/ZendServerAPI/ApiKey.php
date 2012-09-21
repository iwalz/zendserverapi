<?php

namespace ZendServerAPI;

class ApiKey
{
    /**
     * Name of the api key
     * @var string
     */
    private $name = null;
    /**
     * Value of the api key
     * @var string
     */
    private $key = null;
    /**
     * State of the api key
     * @var FULL|READONLY
     */
    private $state = null;
    /**
     * Only access to READ methods
     * @var int
     */
    const READONLY = 1;
    /**
     * Access to all methods
     * @var int
     */
    const FULL = 2;

    /**
     * Constructor for ApiKey model class
     *
     * @param string $name Name of the api key
     * @param string $key  The api key value
     * @param int State of the api key
     */
    public function __construct($name = null, $key = null, $state = self::READONLY)
    {
        $this->name = $name;
        $this->key = $key;
        $this->state = $state;
    }

    /**
     * Set the name of the API Key
     *
     * @param string $name Apikey name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Set READ or FULL state for API Key
     *
     * @param int 1 | 2
     * @throws InvalidArgumentException
     */
    public function setState($state)
    {
        if($state === self::READONLY || $state === self::FULL)
            $this->state = $state;
        else
            throw new \InvalidArgumentException("State has to be \ZendServerAPI\ApiKey::READONLY or \ZendServerAPI\ApiKey::Full");
    }

    /**
     * Set Key value
     *
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * Get name of the API Key
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the state of the current API Key
     *
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Get the Key value
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }
}
