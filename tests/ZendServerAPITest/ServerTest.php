<?php
namespace ZendServerAPITest;

use \ZendServerAPITest\Method\ClusterRemoveServerTest;
use \ZendServerAPITest\Method\ClusterGetServerStatusTest;
use \ZendServerAPITest\Method\ClusterReconfigureServerTest;
use \ZendServerAPITest\Method\RestartTest;
use \ZendServerAPITest\Method\ClusterEnableServerTest;
use \ZendServerAPITest\Method\ClusterDisableServerTest;
use \ZendServerAPITest\Method\GetSystemInfoTest;

use \ZendService\ZendServerAPI\Method\ClusterEnableServer,
    \ZendService\ZendServerAPI\Method\RestartPHP,
    \ZendService\ZendServerAPI\Method\ClusterReconfigureServer,
    \ZendService\ZendServerAPI\Method\ClusterAddServer,
    \ZendService\ZendServerAPI\Method\ClusterRemoveServer,
    \ZendService\ZendServerAPI\Method\ClusterDisableServer,
    \ZendService\ZendServerAPI\Method\GetSystemInfo,
    \ZendService\ZendServerAPI\Method\ClusterGetServerStatus;

use \ZendService\ZendServerAPI\Server,
    \ZendService\ZendServerAPI\Startup,
    \ZendService\ZendServerAPI\Request;
/**
 * test case.
 */
class ServerTest extends \PHPUnit_Framework_TestCase {
	
	public function testConstructorInjection()
	{
	    $tmpRequest = new Request();
	    $tmpRequest->setConfig(new \ZendService\ZendServerAPI\Config());
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
	
	public function testAPIObject()
	{
	    $server1 = new Server;
	    $request1 = $server1->getRequest();
	    
	    $server2 = new Server;
	    $request2 = $server2->getRequest();
	    
	    $this->assertNotSame($request1->getConfig()->getApiKey(),     $request2->getConfig()->getApiKey());
	    $this->assertEquals($request1->getConfig()->getApiKey(),     $request2->getConfig()->getApiKey());
	}
	
	public function testConfigObject()
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
	    $this->assertInstanceOf("\ZendService\ZendServerAPI\ApiKey", $apiKey1);
	    
	    $apiKey2 = $server2->getRequest()->getConfig()->getApiKey();
	    $this->assertInstanceOf("\ZendService\ZendServerAPI\ApiKey", $apiKey1);
	    
	    $this->assertEquals($apiKey1->getName(), 'api');
	    $this->assertEquals($apiKey2->getName(), 'api');
	}
	
	public function testGetSystemInfo()
	{
	    $responseStub = $this->getMock('\Zend\Http\Response', array('getBody'));
	    $responseStub->expects($this->once())->method('getBody')->will($this->returnValue(GetSystemInfoTest::$GetSystemInfoResponse));
	    
	    $clientStub = $this->getMock('\Zend\Http\Client', array('send'));
	    $clientStub->expects($this->once())->method('send')->will($this->returnValue($responseStub));
	    
	    $server = new Server("example62");
	    $server->setClient($clientStub);
	    $this->assertEquals(GetSystemInfoTest::getSystemInfo(), $server->getSystemInfo());
	}
	
	public function testClusterDisableServer()
	{
	    $responseStub = $this->getMock('\Zend\Http\Response', array('getBody'));
	    $responseStub->expects($this->once())->method('getBody')->will($this->returnValue(ClusterDisableServerTest::$ClusterDisableServerResponse));
	     
	    $clientStub = $this->getMock('\Zend\Http\Client', array('send'));
	    $clientStub->expects($this->once())->method('send')->will($this->returnValue($responseStub));
	     
	    $server = new Server("example62");
	    $server->setClient($clientStub);
	    $this->assertEquals(ClusterDisableServerTest::getClusterDisableServer(), $server->clusterDisableServer(ClusterDisableServerTest::getParameter()));
	}
	
	public function testClusterEnableServer()
	{
	    $responseStub = $this->getMock('\Zend\Http\Response', array('getBody'));
	    $responseStub->expects($this->once())->method('getBody')->will($this->returnValue(ClusterEnableServerTest::$ClusterEnableServerResponse));
	
	    $clientStub = $this->getMock('\Zend\Http\Client', array('send'));
	    $clientStub->expects($this->once())->method('send')->will($this->returnValue($responseStub));
	
	    $server = new Server("example62");
	    $server->setClient($clientStub);
	    $this->assertEquals(ClusterEnableServerTest::getClusterEnableServer(), $server->clusterEnableServer(ClusterEnableServerTest::getParameter()));
	}
	
	public function testRestartPhp()
	{
	    $responseStub = $this->getMock('\Zend\Http\Response', array('getBody'));
	    $responseStub->expects($this->once())->method('getBody')->will($this->returnValue(RestartTest::$RestartPHPResponse));
	
	    $clientStub = $this->getMock('\Zend\Http\Client', array('send'));
	    $clientStub->expects($this->once())->method('send')->will($this->returnValue($responseStub));
	
	    $server = new Server("example62");
	    $server->setClient($clientStub);
	    $this->assertEquals(RestartTest::getRestartPHP(), $server->restartPhp(RestartTest::getParameter()));
	}
	
	public function testClusterReconfigureServer()
	{
	    $responseStub = $this->getMock('\Zend\Http\Response', array('getBody'));
	    $responseStub->expects($this->once())->method('getBody')->will($this->returnValue(ClusterReconfigureServerTest::$ClusterReconfigureServerResponse));
	
	    $clientStub = $this->getMock('\Zend\Http\Client', array('send'));
	    $clientStub->expects($this->once())->method('send')->will($this->returnValue($responseStub));
	
	    $server = new Server("example62");
	    $server->setClient($clientStub);
	    $this->assertEquals(ClusterReconfigureServerTest::getClusterReconfigureServer(), $server->clusterReconfigureServer(ClusterReconfigureServerTest::getParameter()));
	}
	
	public function testClusterGetServerStatus()
	{
	    $responseStub = $this->getMock('\Zend\Http\Response', array('getBody'));
	    $responseStub->expects($this->once())->method('getBody')->will($this->returnValue(ClusterGetServerStatusTest::$ClusterGetServerStatusResponse));
	
	    $clientStub = $this->getMock('\Zend\Http\Client', array('send'));
	    $clientStub->expects($this->once())->method('send')->will($this->returnValue($responseStub));
	
	    $server = new Server("example62");
	    $server->setClient($clientStub);
	    $this->assertEquals(ClusterGetServerStatusTest::getClusterGetServerStatus(), $server->clusterGetServerStatus(ClusterGetServerStatusTest::getParameters()));
	}
	
	public function testClusterRemoveServer()
	{
	    $responseStub = $this->getMock('\Zend\Http\Response', array('getBody'));
	    $responseStub->expects($this->once())->method('getBody')->will($this->returnValue(ClusterRemoveServerTest::$ClusterRemoveServerResponse));
	
	    $clientStub = $this->getMock('\Zend\Http\Client', array('send'));
	    $clientStub->expects($this->once())->method('send')->will($this->returnValue($responseStub));
	
	    $server = new Server("example62");
	    $server->setClient($clientStub);
	    $this->assertEquals(ClusterRemoveServerTest::getClusterRemoveServer(), $server->clusterRemoveServer(ClusterRemoveServerTest::getParameter()));
	}
}

