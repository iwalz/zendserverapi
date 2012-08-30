<?php

namespace ZendServerAPI;

class Server extends BaseAPI 
{
	public function __construct($name = null, \ZendServerAPI\Request $request = null)
	{
	    parent::__construct($name);
	    
		if($request !== null)
			$this->request = $request;
	}
	
	public function getSystemInfo()
	{
		$this->request->setAction(new \ZendServerAPI\Method\GetSystemInfo());
		return $this->request->send();
	}
	
	public function clusterGetServerStatus(array $parameters)
	{
	    $this->request->setAction(new \ZendServerAPI\Method\ClusterGetServerStatus($parameters));
	    return $this->request->send();
	}

}

?>