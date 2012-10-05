<?php
namespace ZendServerAPI\Adapter;

abstract class Adapter
{
    /**
     * The Guzzle response object
     * @var \Guzzle\Http\Message\Response
     */
    protected $response = null;

    /**
     * Parse the xml response in object mappings
     *
     * @param string $xml
     */
    abstract public function parse();

    /**
     * Set the Guzzle Response
     *
     * @param \Guzzle\Http\Message\Response
     */
    public function setResponse(\Guzzle\Http\Message\Response $response)
    {
        $this->response = $response;
    }

    /**
     * Get the Guzzle Response
     *
     * @return \Guzzle\Http\Message\Response
     */
    public function getResponse()
    {
        return $this->response ;
    }
}
