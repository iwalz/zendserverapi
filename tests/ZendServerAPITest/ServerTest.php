<?php
namespace ZendServerAPITest;

use ZendServerAPI\Method\ClusterGetServerStatus;

use ZendServerAPI\Server,
    ZendServerAPI\Method\GetSystemInfo,
    ZendServerAPI\Startup,
    ZendServerAPI\Request,
    Zend\Di\Di;
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
		$stub->expects($this->once())->method('send')->will($this->returnValue(SystemInfoTest::$systemInfoObject));
		
		$server = new Server($stub);
		
		$this->assertEquals(SystemInfoTest::$systemInfoObject, $server->getSystemInfo());
	}
	
	public function provider()
	{
	    return array(
	        array(
	            new GetSystemInfo(),
	            SystemInfoTest::$systemInfo,
	            SystemInfoTest::$systemInfoObject
	        ),
	        array(
	            new ClusterGetServerStatus(),
	            \ServersListTest::$serversList,
	            \ServersListTest::$serversListObject,
            )
        );
	}
	
	public function testConstructorInjection()
	{
	    $tmpDi = new Di;
	    $tmpRequest = new Request();
	    $server = new Server($tmpRequest, $tmpDi);
	    $serverRequest = $server->getRequest();
	    $serverDi = $server->getDi();
	    
	    $di = Startup::getDIC();
	    $request = $di->get('ZendServerAPI\Request');
	    
	    $this->assertNotSame($serverRequest, $request);
	    $this->assertNotSame($serverDi, $di);
	}
	
	public function testRequestObjectInDI()
	{
	    $server1 = new Server;
	    $server2 = new Server;
	    
	    $this->assertSame($server1->getRequest(), $server2->getRequest());
	}
	
	public function testAPIObjectInDI()
	{
	    $server1 = new Server;
	    $request1 = $server1->getRequest();
	    
	    $server2 = new Server;
	    $request2 = $server2->getRequest();
	    
	    $this->assertSame($request1->getConfig()->getApiKey(),     $request2->getConfig()->getApiKey());
	}
	
	public function testConfigObjectInDI()
	{
	    $server1 = new Server;
	    $request1 = $server1->getRequest();
	     
	    $server2 = new Server;
	    $request2 = $server2->getRequest();
	     
	    $this->assertSame($request1->getConfig(), $request2->getConfig());
	}
	
	public function testGetterAndSetter()
	{
	    $request = new Request;
	    $di = new Di;
	    $server = new Server;
	    
	    $this->assertNotSame($request, $server->getRequest());
	    $server->setRequest($request);
	    $this->assertSame($request, $server->getRequest());
	    
	    $this->assertNotSame($di, $server->getDI());
	    $server->setDI($di);
	    $this->assertSame($di, $server->getDI());
	}
	
	public function testProd()
	{
	    /*$server = new Server;
	    var_dump($server->getSystemInfo());
 	    var_dump($server->clusterGetServerStatus());*/
	}
	
}

