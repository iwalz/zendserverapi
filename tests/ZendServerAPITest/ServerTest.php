<?php

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * test case.
 */
class ServerTest extends PHPUnit_Framework_TestCase {
	
	private $server = null;
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {

	}
	
	public function testGetSystemInfo()
	{
		$stub = $this->getMock('\ZendServerAPI\Request', array('send', 'setAction'));
		$stub->expects($this->once())->method('setAction')->with(new \ZendServerAPI\Method\GetSystemInfo());
		$stub->expects($this->once())->method('send');
		
		$this->server = new \ZendServerAPI\Server($stub);
		
		$this->server->getSystemInfo();
	}
	
}

