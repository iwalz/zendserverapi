<?php
namespace ZendServerAPITest;

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
	
}

