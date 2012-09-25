<?php
namespace ZendServerAPI;

class BaseAPI
{
    /**
     * Request for the methods
     * @var \ZendServerAPI\Request
     */
    protected $request = null;

    /**
     * Api Factory to fetch Method's from there
     * @var Factories\CommandFactory
     */
    protected $apiFactory = null;
    /**
     * Base constructor for all method implementations
     * @param string $name Name of the config
     */
    public function __construct($name = null, Request $request = null)
    {
        if($request !== null) {
            $this->request = $request;
        } else {
            $this->request = Startup::getRequest($name);
        }
        
        $webApiVersionFactory = new Factories\WebApiVersionFactory();
        $webApiVersionFactory->setConfig($this->request->getConfig()); 
        $this->apiFactory = $webApiVersionFactory->getCommandFactory();
    }

    /**
     * Returns the current request
     *
     * @return \ZendServerAPI\Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Set the request for the current context
     *
     * @param \ZendServerAPI\Request $request
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Set the client. Most likly for testing
     *
     * @param \Guzzle\Http\Client $client
     */
    public function setClient(\Guzzle\Http\Client $client)
    {
        $this->request->setClient($client);
    }

    /**
     * Check if connection is possible or not
     *
     * @return boolean
     */
    public function canConnect()
    {
        $previousAction = $this->request->getAction();
        $action = new \ZendServerAPI\Method\GetSystemInfo();
        $this->request->setAction($action);
        try {
            $response = $this->request->send();
        } catch ( \Guzzle\Http\Exception\CurlException $e) {
            if($previousAction !== null)
                $this->request->setAction($previousAction);

            return false;
        }

        if($previousAction !== null)
            $this->request->setAction($previousAction);

        return true;
    }
}
