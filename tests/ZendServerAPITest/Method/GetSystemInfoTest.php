<?php

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * test case.
 */
class GetSystemInfoTest extends PHPUnit_Framework_TestCase {
	
	public function testGetSystemInfoMethod()
	{
		$systemInfo = new \ZendServerAPI\Method\GetSystemInfo();
		$this->assertNotNull($systemInfo);
	}
}

