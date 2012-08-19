<?php

namespace ZendServerAPI;

class Server extends Startup 
{
	private $request = null;
	
	public function __construct()
	{
		parent::startup();
		$this->request = self::$di->get('ZendServerAPI\Request');
	}
	
	public function getSystemInfo()
	{
		return $this->request->setAction(new \ZendServerAPI\Method\GetSystemInfo())->send();
	}
}

?>