<?php

namespace ZendServerAPI;

class Server 
{
	private $request = null;
	
	public function __construct(\ZendServerAPI\Request $request = null, $di = null)
	{
	    if($di === null)
            $di = Startup::startup();

		if($request === null)
			$this->request = $di->get('ZendServerAPI\Request');
		else
			$this->request = $request;
	}
	
	public function getSystemInfo()
	{
		$this->request->setAction(new \ZendServerAPI\Method\GetSystemInfo());
		return $this->request->send();
	}
}

?>