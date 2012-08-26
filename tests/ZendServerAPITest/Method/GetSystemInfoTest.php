<?php
namespace ZendServerAPITest;

/**
 * test case.
 */
class GetSystemInfoTest extends \PHPUnit_Framework_TestCase {
	
	public function testGetSystemInfoMethod()
	{
		$systemInfo = $this->getMock('\ZendServerAPI\Method\GetSystemInfo', array('setMethod', 'setFunctionPath'));
		$systemInfo->expects($this->once())->method('setMethod')->with('GET');
		$systemInfo->expects($this->once())->method('setFunctionPath')->with('/ZendServerManager/Api/getSystemInfo');
		
		$systemInfo->configure();
	}
	
	public function testClusterGetServerStatus()
	{
	    $systemInfo = $this->getMock('\ZendServerAPI\Method\ClusterGetServerStatus', array('setMethod', 'setFunctionPath'));
	    $systemInfo->expects($this->once())->method('setMethod')->with('GET');
	    $systemInfo->expects($this->once())->method('setFunctionPath')->with('/ZendServerManager/Api/clusterGetServerStatus');
	
	    $systemInfo->configure();
	}
}

