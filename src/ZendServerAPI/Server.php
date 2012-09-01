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
	    var_dump($this->request);
		$this->request->setAction(new \ZendServerAPI\Method\GetSystemInfo());
		var_dump($this->request);
		$foo = $this->request->send();
		var_dump($foo);
		return $foo;
	}
	
	public function clusterGetServerStatus(array $parameters)
	{
	    $this->request->setAction(new \ZendServerAPI\Method\ClusterGetServerStatus($parameters));
	    return $this->request->send();
	}
	
	public function clusterRemoveServer($serverId)
	{
	    $this->request->setAction(new \ZendServerAPI\Method\ClusterRemoveServer($serverId));
	    return $this->request->send();
	}
	
	public function clusterAddServer($serverName, $serverUrl, $guiPassword)
	{
	    $this->request->setAction(new \ZendServerAPI\Method\ClusterAddServer($serverName, $serverUrl, $guiPassword));
	    return $this->request->send();
	}

}

?>