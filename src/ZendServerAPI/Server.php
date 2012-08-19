<?php

namespace ZendServerAPI;

class Server extends Startup 
{
	private $request = null;
	
	public function __construct(\ZendServerAPI\Request $request = null)
	{
		parent::startup();
		if($request === null)
			$this->request = self::$di->get('ZendServerAPI\Request');
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