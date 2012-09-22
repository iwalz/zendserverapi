<?php
namespace ZendServerAPI;

class Codetracing extends BaseAPI
{

    /**
     * Constructor for Codetracing Zend Server API section
     *
     * @param string Name for connection
     * @param \ZendServerAPI\Request $request
     */
    public function __construct($name = null, Request $request = null)
    {
        parent::__construct($name);

        if($request !== null)
            $this->request = $request;
    }

    public function codetracingEnable($restartNow = true)
    {
        $this->request->setAction(new \ZendServerAPI\Method\CodetracingEnable($restartNow));
        return $this->request->send();
    }
    
    public function codetracingDisable($restartNow = true)
    {
        $this->request->setAction(new \ZendServerAPI\Method\CodetracingDisable($restartNow));
        return $this->request->send();
    }
    
    public function codetracingIsEnabled()
    {
        $this->request->setAction(new \ZendServerAPI\Method\CodetracingIsEnabled());
        return $this->request->send();
    }
}
