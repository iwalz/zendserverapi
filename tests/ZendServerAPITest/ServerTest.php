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
		$this->server = new \ZendServerAPI\Server();
		$this->assertTrue(true);
	}
	
	public function testGetSystemInfo()
	{
		echo $this->server->getSystemInfo();
	}
}

