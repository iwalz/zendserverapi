<?php
namespace ZendServerAPITest;

/**
 * test case.
 */
class ServerTest extends \PHPUnit_Framework_TestCase {
	
	/**
	 * @dataProvider provider
	 */
	public function testMethods($action, $xml, $model)
	{
		$stub = $this->getMock('\ZendServerAPI\Request', array('send', 'setAction'));
		$stub->expects($this->once())->method('setAction')->with($action);
		$stub->expects($this->once())->method('send')->will($this->returnValue(SystemInfoTest::$systemInfoObject));
		
		$server = new \ZendServerAPI\Server($stub);
		
		$this->assertEquals(SystemInfoTest::$systemInfoObject, $server->getSystemInfo());
	}
	
	public function provider()
	{
	    return array(
	        array(
	                new \ZendServerAPI\Method\GetSystemInfo(),
	                SystemInfoTest::$systemInfo,
	                SystemInfoTest::$systemInfoObject
	        ),
        );
	}
	
	public function testProd()
	{
	    $server = new \ZendServerAPI\Server();
	    $this->assertNotNull($server->getSystemInfo());
	}
	
}

