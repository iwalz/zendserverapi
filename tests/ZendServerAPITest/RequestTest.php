<?php
namespace ZendServerAPITest;

use ZendServerAPITest\Method\ClusterRemoveServerTest;

use ZendServerAPITest\Method\ClusterAddServerTest;

use ZendServerAPITest\Method\GetSystemInfoTest;

use ZendServerAPI\DataTypes\ServerInfo;

use ZendServerAPI\DataTypes\SystemInfo;

use ZendServerAPI\Startup;

use ZendServerAPI\Method\GetSystemInfo;

use ZendServerAPI\Request;

/**
 * test case.
 */
class RequestTest extends \PHPUnit_Framework_TestCase {

    private $apiKey = null;
    private $config = null;
    
    public function setUp()
    {
        $this->apiKey = new \ZendServerAPI\ApiKey();
        $this->apiKey->setName('api');
        $this->apiKey->setKey('058b82f191d934a7bfe17d12060dd3320869f132d3428fa19d35463903673eee');
        $this->apiKey->setState(\ZendServerAPI\ApiKey::FULL);
        
        $this->config = new \ZendServerAPI\Config;
        $this->config->setHost('127.0.0.1');
        $this->config->setApiKey($this->apiKey);
    }
    
	public function testConfig()
	{
	    $request = new \ZendServerAPI\Request();
		$request->setConfig($this->config);
		$this->assertInstanceOf('\ZendServerAPI\ApiKey', $request->getConfig()->getApiKey());
		$this->assertSame('api', $request->getConfig()->getApiKey()->getName());
		$this->assertSame('058b82f191d934a7bfe17d12060dd3320869f132d3428fa19d35463903673eee', $request->getConfig()->getApiKey()->getKey());
		$this->assertEquals(\ZendServerAPI\ApiKey::FULL, $request->getConfig()->getApiKey()->getState());
	}
	
	public function testGenerateRequestSignature()
	{
	    $config = new \ZendServerAPI\Config();
	    $apiKey = new \ZendServerAPI\ApiKey();
	    $apiKey->setKey('9dc7f8c5ac43bb2ab36120861b4aeda8f9bb6c521e124360fd5821ef279fd9c7');
	    $apiKey->setName('angel.eyes');
	    $apiKey->setState(\ZendServerAPI\ApiKey::FULL);
	    
	    $config->setHost('zscm.local');
	    $config->setApiKey($apiKey);
	    
	    $request = new \ZendServerAPI\Request();
	    $request->setUserAgent('Zend_Http_Client/1.10');
	    $request->setConfig($config);
	    $this->assertEquals('Zend_Http_Client/1.10', $request->getUserAgent());
	    
	    $action = $this->getMock('\ZendServerAPI\Method\GetSystemInfo', array('getFunctionPath'));
	    $action->expects($this->any())->method('getFunctionPath')->will($this->returnValue('/ZendServer/Api/findTheFish'));
	    
	    $request->setAction($action);
	    $this->assertInstanceOf('\ZendServerAPI\Method\GetSystemInfo', $request->getAction());
	    $method = new \ReflectionMethod('\ZendServerAPI\Request', 'generateRequestSignature');
	    $method->setAccessible(true);
	    
 	    $this->assertEquals('785be59b7728b1bfd6495d610271c5d47ff0737775b09191daeb5a728c2d97c0', $method->invoke($request, 'Sun, 11 Jul 2010 13:16:10 GMT'));
	}
	
	public function testGmtInDate()
	{
	    $method = new \ReflectionMethod('\ZendServerAPI\Request', 'getDate');
	    $method->setAccessible(true);
	    
	    $this->assertStringEndsWith('GMT', $method->invoke(new Request()));
	}
	
	public function testSendWithGetAction()
	{
	    $request = new \ZendServerAPI\Request();
	    $request->setConfig($this->config);
	    
	    $action = new \ZendServerAPI\Method\GetSystemInfo();
	    $request->setAction($action);
	    
	    $responseStub = $this->getMock('\Guzzle\Http\Message\Response', array('getBody'), array(200, array(), GetSystemInfoTest::$GetSystemInfoResponse));
	    $responseStub->expects($this->once())->method('getBody')->will($this->returnValue(GetSystemInfoTest::$GetSystemInfoResponse));

	    $clientStub = $this->getMock('\Guzzle\Http\Client', array('send'));
        $clientStub->expects($this->once())->method('send')->will($this->returnValue($responseStub));
	    
	    $request->setClient($clientStub);
	    $request->send();
	}
	
	public function testSendWithPostAction()
	{
	    $request = new \ZendServerAPI\Request();
	    $request->setConfig($this->config);
	     
	    $action = new \ZendServerAPI\Method\ClusterAddServer("zendserver2", 'http://127.1.1.1:10081/ZendServer', 'foo');
	    $request->setAction($action);
	     
	    $responseStub = $this->getMock('\Guzzle\Http\Message\Response', array('getBody'), array(200, array(), ClusterAddServerTest::$ClusterAddServerResponse));
	    $responseStub->expects($this->once())->method('getBody')->will($this->returnValue(ClusterAddServerTest::$ClusterAddServerResponse));
	
	    $clientStub = $this->getMock('\Guzzle\Http\Client', array('send'));
	    $clientStub->expects($this->once())->method('send')->will($this->returnValue($responseStub));
	     
	    $request->setClient($clientStub);
	    $request->send();
	}
	
	public function testSendWithGuzzleExceptionClientCode()
	{
	    $this->setExpectedException("\ZendServerAPI\Exception\ClientSide", "authError: Incorrect signature", 402);
	    $request = new \ZendServerAPI\Request();
	    $request->setConfig($this->config);
	
	    $action = new \ZendServerAPI\Method\ClusterAddServer("zendserver2", 'http://127.1.1.1:10081/ZendServer', 'foo');
	    $request->setAction($action);
	
	    $clientStub = $this->getMock('\Guzzle\Http\Client', array('send'));
	    $callback = function() { throw new \Guzzle\Http\Exception\BadResponseException(ClientSideTest::$Response, 402); };
	    $clientStub->expects($this->once())->method('send')->will($this->returnCallback($callback));
	
	    $request->setClient($clientStub);
	    $request->send();
	}
	
	public function testSendWithGuzzleExceptionServerCode()
	{
	    $this->setExpectedException("\ZendServerAPI\Exception\ServerSide", "serverNotLicensed: Zend Server Cluster Manager is not licensed.", 502);
	    $request = new \ZendServerAPI\Request();
	    $request->setConfig($this->config);
	
	    $action = new \ZendServerAPI\Method\ClusterAddServer("zendserver2", 'http://127.1.1.1:10081/ZendServer', 'foo');
	    $request->setAction($action);
	
	    $clientStub = $this->getMock('\Guzzle\Http\Client', array('send'));
	    $callback = function() { throw new \Guzzle\Http\Exception\BadResponseException(\ServerSideTest::$Response, 502); };
	    $clientStub->expects($this->once())->method('send')->will($this->returnCallback($callback));
	
	    $request->setClient($clientStub);
	    $request->send();
	}
	
	public function testSendWithGuzzleExceptionCode()
	{
	    $this->setExpectedException("\InvalidArgumentException", "Foo", 602);
	    $request = new \ZendServerAPI\Request();
	    $request->setConfig($this->config);
	
	    $action = new \ZendServerAPI\Method\ClusterAddServer("zendserver2", 'http://127.1.1.1:10081/ZendServer', 'foo');
	    $request->setAction($action);
	
	    $clientStub = $this->getMock('\Guzzle\Http\Client', array('send'));
	    $callback = function() { throw new \Guzzle\Http\Exception\BadResponseException("Foo", 602); };
	    $clientStub->expects($this->once())->method('send')->will($this->returnCallback($callback));
	
	    $request->setClient($clientStub);
	    $request->send();
	}
}

