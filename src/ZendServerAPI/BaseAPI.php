<?php
namespace ZendServerAPI;

class BaseAPI
{
    protected $request = null;
    
    public function __construct($name = null)
    {
        $this->request = Startup::getRequest($name);
    }
    
    public function getRequest()
    {
        return $this->request;
    }
    
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }
}

?>