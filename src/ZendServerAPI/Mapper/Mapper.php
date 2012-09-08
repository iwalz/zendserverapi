<?php
namespace ZendServerAPI\Mapper;

abstract class Mapper
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
    abstract function parse();
    
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

?>