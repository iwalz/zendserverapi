<?php

namespace ZendServerAPI;

class Server extends BaseAPI 
{
	public function __construct($name = null, \ZendServerAPI\Request $request = null, \Zend\Di\Di $di = null)
	{
	    parent::__construct($name);
	    
	    if(null !== $di)
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
	
	public function clusterGetServerStatus(array $parameters)
	{
	    if($this->request === null)
	        $this->request = $this->di->get('ZendServerAPI\Request');
	     
	    $this->request->setAction(new \ZendServerAPI\Method\ClusterGetServerStatus($parameters));
	    return $this->request->send();
	}

}

?>