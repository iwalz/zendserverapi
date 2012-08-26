<?php
namespace ZendServerAPITest;

use ZendServerAPI\Method\ClusterEnableServer;

use ZendServerAPI\Method\RestartPHP;

use ZendServerAPI\Method\ClusterReconfigureServer;

use ZendServerAPI\Method\ClusterAddServer;

use ZendServerAPI\Method\ClusterRemoveServer;

use ZendServerAPI\Method\ClusterDisableServer;

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
		/*$requestStub = $this->getMock('\ZendServerAPI\Request', array('send', 'setAction'));
		$requestStub->expects($this->once())->method('setAction')->with($action);
		$requestStub->expects($this->once())->method('send')->will($this->returnValue($model));
		
		$server = new Server($requestStub);
		$server->getSystemInfo();*/
		
 		$this->assertEquals($action->parseResponse($xml), $model);
		
	}
	
	/**
	 * @depends testParseResultSystemInfo
	 */
	public function provider()
	{
	    return array(
	        array(
	            new GetSystemInfo(),
	            GetSystemInfoTest::$GetSystemInfoResponse,
	            GetSystemInfoTest::getSystemInfo()
	        ),
	        /*array(
	            new ClusterGetServerStatus(),
	            ClusterGetServerStatusTest::$ClusterGetServerStatusResponse,
	            ClusterGetServerStatusTest::$ClusterGetServerStatusObject,
            ),
            array(
                new ClusterDisableServer(),
                ClusterDisableServerTest::$ClusterDisableServerResponse,
                ClusterDisableServerTest::$ClusterDisableServerObject,
            ),
            array(
                new ClusterRemoveServer(),
                ClusterRemoveServerTest::$ClusterRemoveServerResponse,
                ClusterRemoveServerTest::$ClusterRemoveServerObject,
            ),*/
            array(
                new ClusterAddServer(),
                ClusterAddServerTest::$ClusterAddServerResponse,
                ClusterAddServerTest::getAddServerObject(),
            )
            /*array(
                new ClusterReconfigureServer(),
                ClusterReconfigureServerTest::$ClusterReconfigureServerResponse,
                ClusterReconfigureServerTest::$ClusterReconfigureServerObject,
            ),
            array(
                new RestartPHP(),
                RestartPHPTest::$RestartPHPResponse,
                RestartPHPTest::$RestartPHPObject,
            ),
            array(
                new ClusterEnableServer(),
                ClusterEnableServerTest::$ClusterEnableServerResponse,
                ClusterEnableServerTest::$ClusterEnableServerObject,
            ),*/
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

