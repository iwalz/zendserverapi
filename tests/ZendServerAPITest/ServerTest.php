<?php
namespace ZendServerAPITest;

use ZendServerAPI\Method\ClusterEnableServer,
    ZendServerAPI\Method\RestartPHP,
    ZendServerAPI\Method\ClusterReconfigureServer,
    ZendServerAPI\Method\ClusterAddServer,
    ZendServerAPI\Method\ClusterRemoveServer,
    ZendServerAPI\Method\ClusterDisableServer,
    ZendServerAPI\Method\GetSystemInfo,
    ZendServerAPI\Method\ClusterGetServerStatus;

use ZendServerAPI\Server,
    ZendServerAPI\Startup,
    ZendServerAPI\Request;
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
	        array(
	            new ClusterGetServerStatus(ClusterGetServerStatusTest::getParameters()),
	            ClusterGetServerStatusTest::$ClusterGetServerStatusResponse,
	            ClusterGetServerStatusTest::getClusterGetServerStatus(),
            ),
            array(
                new ClusterDisableServer(),
                ClusterDisableServerTest::$ClusterDisableServerResponse,
                ClusterDisableServerTest::getClusterDisableServer(),
            ),
            array(
                new ClusterRemoveServer(ClusterRemoveServerTest::getParameter()),
                ClusterRemoveServerTest::$ClusterRemoveServerResponse,
                ClusterRemoveServerTest::getClusterRemoveServer(),
            ),
            array(
                new ClusterAddServer(ClusterAddServerTest::getServerName(), ClusterAddServerTest::getServerUrl(), ClusterAddServerTest::getGuiPassword()),
                ClusterAddServerTest::$ClusterAddServerResponse,
                ClusterAddServerTest::getAddServerObject(),
            ),
            array(
                new ClusterReconfigureServer(),
                ClusterReconfigureServerTest::$ClusterReconfigureServerResponse,
                ClusterReconfigureServerTest::getClusterReconfigureServer(),
            ),
            array(
                new RestartPHP(),
                RestartPHPTest::$RestartPHPResponse,
                RestartPHPTest::getRestartPHP(),
            ),
            array(
                new ClusterEnableServer(),
                ClusterEnableServerTest::$ClusterEnableServerResponse,
                ClusterEnableServerTest::getClusterEnableServer(),
            )
        );
	}
	
	public function testConstructorInjection()
	{
	    $tmpRequest = new Request();
	    $server = new Server("general", $tmpRequest);
	    $serverRequest = $server->getRequest();
	    
	    $request = Startup::getRequest();
	    
	    $this->assertNotSame($serverRequest, $request);
	}
	
	public function testRequestObjectInDI()
	{
	    $server1 = new Server;
	    $server2 = new Server;
	    
	    $this->assertNotSame($server1->getRequest(), $server2->getRequest());
	    $this->assertEquals($server1->getRequest(), $server2->getRequest());
	}
	
	public function testAPIObjectInDI()
	{
	    $server1 = new Server;
	    $request1 = $server1->getRequest();
	    
	    $server2 = new Server;
	    $request2 = $server2->getRequest();
	    
	    $this->assertNotSame($request1->getConfig()->getApiKey(),     $request2->getConfig()->getApiKey());
	    $this->assertEquals($request1->getConfig()->getApiKey(),     $request2->getConfig()->getApiKey());
	}
	
	public function testConfigObjectInDI()
	{
	    $server1 = new Server;
	    $request1 = $server1->getRequest();
	     
	    $server2 = new Server;
	    $request2 = $server2->getRequest();
	     
	    $this->assertNotSame($request1->getConfig(), $request2->getConfig());
	    $this->assertEquals($request1->getConfig(), $request2->getConfig());
	}
	
	public function testGetterAndSetter()
	{
	    $request = new Request;
	    $server = new Server;
	    
	    $this->assertNotSame($request, $server->getRequest());
	    $server->setRequest($request);
	    $this->assertSame($request, $server->getRequest());
	    
	}
	
	public function testApiKeyInstances()
	{
	    $server1 = new Server();
	    $server2 = new Server("example62");
	    
	    $this->assertNotSame($server1, $server2);
	    
	    $apiKey1 = $server1->getRequest()->getConfig()->getApiKey();
	    $this->assertInstanceOf("\ZendServerAPI\ApiKey", $apiKey1);
	    
	    $apiKey2 = $server2->getRequest()->getConfig()->getApiKey();
	    $this->assertInstanceOf("\ZendServerAPI\ApiKey", $apiKey1);
	    
	    $this->assertEquals($apiKey1->getName(), 'api');
	    $this->assertEquals($apiKey2->getName(), 'apikey');
	}
	
}

