<?php

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * test case.
 */
class GetSystemInfoTest extends PHPUnit_Framework_TestCase {
	
	public function testGetSystemInfoMethod()
	{
		$systemInfo = $this->getMock('\ZendServerAPI\Method\GetSystemInfo', array('configure'));
		$systemInfo->expects($this->once())->method('configure');
		
		$systemInfo->configure();
	}
}

