<?php

namespace ZendServerAPI;

class Server extends BaseAPI 
{
	public function __construct(\ZendServerAPI\Request $request = null, \Zend\Di\Di $di = null)
	{
	    if($di === null)
	        $this->di = Startup::getDIC();
	    else
	        $this->di = $di;
	    
		if($request !== null)
			$this->request = $request;
	}
	
	public function getSystemInfo()
	{
	    if($this->request === null)
            $this->request = $this->di->get('ZendServerAPI\Request');
	    
		$this->request->setAction(new \ZendServerAPI\Method\GetSystemInfo());
		return $this->request->send();
	}
	
	public function clusterGetServerStatus()
	{
	    if($this->request === null)
	        $this->request = $this->di->get('ZendServerAPI\Request');
	     
	    $this->request->setAction(new \ZendServerAPI\Method\ClusterGetServerStatus());
	    return $this->request->send();
	}

}

?>