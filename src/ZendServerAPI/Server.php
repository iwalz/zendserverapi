<?php

namespace ZendServerAPI;

class Server 
{
	private $request = null;
	private $di = null;
	
	public function __construct(\ZendServerAPI\Request $request = null, $di = null)
	{
	    if($di === null)
	        $this->di = Startup::getDIC();
	    else
	        $this->di = $di;
	    
		if($request === null)
			$this->request = $this->di->get('ZendServerAPI\Request');
		else
			$this->request = $request;
	}
	
	public function getSystemInfo()
	{
		$this->request->setAction(new \ZendServerAPI\Method\GetSystemInfo());
		return $this->request->send();
	}
	
	public function getRequest()
	{
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