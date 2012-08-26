<?php
namespace ZendServerAPITest;

/**
 * test case.
 */
class MethodImplementationTest extends \PHPUnit_Framework_TestCase {
	
	public function testGetSystemInfoMethod()
	{
		$implementation = $this->getMock('\ZendServerAPI\Method\GetSystemInfo', array('setMethod', 'setFunctionPath'));
		$implementation->expects($this->once())->method('setMethod')->with('GET');
		$implementation->expects($this->once())->method('setFunctionPath')->with('/ZendServerManager/Api/getSystemInfo');
		
		$implementation->configure();
	}
	
	public function testClusterGetServerStatus()
	{
	    $implementation = $this->getMock('\ZendServerAPI\Method\ClusterGetServerStatus', array('setMethod', 'setFunctionPath'));
	    $implementation->expects($this->once())->method('setMethod')->with('GET');
	    $implementation->expects($this->once())->method('setFunctionPath')->with('/ZendServerManager/Api/clusterGetServerStatus');
	
	    $implementation->configure();
	}
	
	public function testRestartPHP()
	{
	    $implementation = $this->getMock('\ZendServerAPI\Method\RestartPHP', array('setMethod', 'setFunctionPath'));
	    $implementation->expects($this->once())->method('setMethod')->with('POST');
	    $implementation->expects($this->once())->method('setFunctionPath')->with('/ZendServerManager/Api/restartPhp');
	    
	    $implementation->configure();
	}
}

