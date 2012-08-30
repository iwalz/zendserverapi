<?php
namespace ZendServerAPI;

class BaseAPI
{
    protected $request = null;
    protected $di = null;
    
    public function __construct($name = null)
    {
        $this->di = Startup::getDIC($name);
    }
    
    public function getRequest()
    {
        if($this->request === null)
            $this->request = $this->di->get('ZendServerAPI\Request');
        
        return $this->request;
    }
    
    public function getDi()
    {
        return $this->di;
    }
    
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }
    
    public function setDi(\Zend\Di\Di $di)
    {
        $this->di = $di;
    }
}

?>