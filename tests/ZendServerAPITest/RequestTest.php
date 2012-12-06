<?php
namespace ZendServerAPITest;

use \ZendServerAPITest\Method\ClusterRemoveServerTest;
use \ZendServerAPITest\Method\ClusterAddServerTest;
use \ZendServerAPITest\Method\GetSystemInfoTest;
use \ZendService\ZendServerAPI\DataTypes\ServerInfo;
use \ZendService\ZendServerAPI\DataTypes\SystemInfo;
use \ZendService\ZendServerAPI\Startup;
use \ZendService\ZendServerAPI\Method\GetSystemInfo;
use \ZendService\ZendServerAPI\Request;

/**
 * test case.
 */
class RequestTest extends \PHPUnit_Framework_TestCase {

    private $apiKey = null;
    private $config = null;
    
    public function setUp()
    {
        $this->apiKey = new \ZendService\ZendServerAPI\ApiKey();
        $this->apiKey->setName('api');
        $this->apiKey->setKey('058b82f191d934a7bfe17d12060dd3320869f132d3428fa19d35463903673eee');
        $this->apiKey->setState(\ZendService\ZendServerAPI\ApiKey::FULL);
        
        $this->config = new \ZendService\ZendServerAPI\Config;
        $this->config->setHost('127.0.0.1');
        $this->config->setApiKey($this->apiKey);
    }
    
	public function testConfig()
	{
	    $request = new \ZendService\ZendServerAPI\Request();
		$request->setConfig($this->config);
		$this->assertInstanceOf('\ZendService\ZendServerAPI\ApiKey', $request->getConfig()->getApiKey());
		$this->assertSame('api', $request->getConfig()->getApiKey()->getName());
		$this->assertSame('058b82f191d934a7bfe17d12060dd3320869f132d3428fa19d35463903673eee', $request->getConfig()->getApiKey()->getKey());
		$this->assertEquals(\ZendService\ZendServerAPI\ApiKey::FULL, $request->getConfig()->getApiKey()->getState());
	}
	
	public function testGenerateRequestSignature()
	{
	    $config = new \ZendService\ZendServerAPI\Config();
	    $apiKey = new \ZendService\ZendServerAPI\ApiKey();
	    $apiKey->setKey('9dc7f8c5ac43bb2ab36120861b4aeda8f9bb6c521e124360fd5821ef279fd9c7');
	    $apiKey->setName('angel.eyes');
	    $apiKey->setState(\ZendService\ZendServerAPI\ApiKey::FULL);
	    
	    $config->setHost('zscm.local');
	    $config->setApiKey($apiKey);
	    
	    $request = new \ZendService\ZendServerAPI\Request();
	    $request->setUserAgent('Zend_Http_Client/1.10');
	    $request->setConfig($config);
	    $this->assertEquals('Zend_Http_Client/1.10', $request->getUserAgent());
	    
	    $action = $this->getMock('\ZendService\ZendServerAPI\Method\GetSystemInfo', array('getFunctionPath'));
	    $action->expects($this->any())->method('getFunctionPath')->will($this->returnValue('/ZendServer/Api/findTheFish'));
	    
	    $request->setAction($action);
	    $this->assertInstanceOf('\ZendService\ZendServerAPI\Method\GetSystemInfo', $request->getAction());
	    $method = new \ReflectionMethod('\ZendService\ZendServerAPI\Request', 'generateRequestSignature');
	    $method->setAccessible(true);
	    
 	    $this->assertEquals('785be59b7728b1bfd6495d610271c5d47ff0737775b09191daeb5a728c2d97c0', $method->invoke($request, 'Sun, 11 Jul 2010 13:16:10 GMT'));
	}
	
	public function testGmtInDate()
	{
	    $method = new \ReflectionMethod('\ZendService\ZendServerAPI\Request', 'getDate');
	    $method->setAccessible(true);
	    
	    $this->assertStringEndsWith('GMT', $method->invoke(new Request()));
	}
	
	public function testSendWithGetAction()
	{
	    $request = new \ZendService\ZendServerAPI\Request();
	    $request->setConfig($this->config);
	    
	    $action = new \ZendService\ZendServerAPI\Method\GetSystemInfo();
	    $request->setAction($action);
	    
	    $responseStub = $this->getMock('\Zend\Http\Response', array('getBody'));
	    $responseStub->expects($this->once())->method('getBody')->will($this->returnValue(GetSystemInfoTest::$GetSystemInfoResponse));

	    $clientStub = $this->getMock('\Zend\Http\Client', array('send'));
        $clientStub->expects($this->once())->method('send')->will($this->returnValue($responseStub));
	    
	    $request->setClient($clientStub);
	    $request->send();
	}
	
	public function testSendWithPostAction()
	{
	    $request = new \ZendService\ZendServerAPI\Request();
	    $request->setConfig($this->config);
	     
	    $action = new \ZendService\ZendServerAPI\Method\ClusterAddServer("zendserver2", 'http://127.1.1.1:10081/ZendServer', 'foo');
	    $request->setAction($action);
	     
	    $responseStub = $this->getMock('\Zend\Http\Response', array('getBody'));
	    $responseStub->expects($this->once())->method('getBody')->will($this->returnValue(ClusterAddServerTest::$ClusterAddServerResponse));
	
	    $clientStub = $this->getMock('\Zend\Http\Client', array('send'));
	    $clientStub->expects($this->once())->method('send')->will($this->returnValue($responseStub));
	     
	    $request->setClient($clientStub);
	    $request->send();
	}
	
/*	public function testSendWithGuzzleExceptionClientCode()
	{
	    $this->setExpectedException("\ZendService\ZendServerAPI\Exception\ClientSide", "authError: Incorrect signature", 402);
	    $request = new \ZendService\ZendServerAPI\Request();
	    $request->setConfig($this->config);
	
	    $action = new \ZendService\ZendServerAPI\Method\ClusterAddServer("zendserver2", 'http://127.1.1.1:10081/ZendServer', 'foo');
	    $request->setAction($action);
	
	    $clientStub = $this->getMock('\Zend\Http\Client', array('send'));
	    $callback = function() { throw new \Zend\Http\Exception\RuntimeException(ClientSideTest::$Response, 402); };
	    $clientStub->expects($this->once())->method('send')->will($this->returnCallback($callback));
	
	    $request->setClient($clientStub);
	    $request->send();
	}
	
	public function testSendWithGuzzleExceptionServerCode()
	{
	    $this->setExpectedException("\ZendService\ZendServerAPI\Exception\ServerSide", "serverNotLicensed: Zend Server Cluster Manager is not licensed.", 502);
	    $request = new \ZendService\ZendServerAPI\Request();
	    $request->setConfig($this->config);
	
	    $action = new \ZendService\ZendServerAPI\Method\ClusterAddServer("zendserver2", 'http://127.1.1.1:10081/ZendServer', 'foo');
	    $request->setAction($action);
	
	    $clientStub = $this->getMock('\Zend\Http\Client', array('send'));
	    $callback = function() { throw new \Zend\Http\Exception\RuntimeException(\ServerSideTest::$Response, 502); };
	    $clientStub->expects($this->once())->method('send')->will($this->returnCallback($callback));
	
	    $request->setClient($clientStub);
	    $request->send();
	}
	
	public function testSendWithGuzzleExceptionCode()
	{
	    $this->setExpectedException("\InvalidArgumentException", "Foo", 602);
	    $request = new \ZendService\ZendServerAPI\Request();
	    $request->setConfig($this->config);
	
	    $action = new \ZendService\ZendServerAPI\Method\ClusterAddServer("zendserver2", 'http://127.1.1.1:10081/ZendServer', 'foo');
	    $request->setAction($action);
	
	    $clientStub = $this->getMock('\Zend\Http\Client', array('send'));
	    $callback = function() { throw new \Zend\Http\Exception\RuntimeException("Foo", 602); };
	    $clientStub->expects($this->once())->method('send')->will($this->returnCallback($callback));
	
	    $request->setClient($clientStub);
	    $request->send();
	}*/
}

