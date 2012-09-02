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
	
	public function testSendWithGetAction()
	{
	    $response = new \stdClass();
	    $response->code = 200;
	    
	    $request = Startup::getRequest();
	    $action = $this->getMock('\ZendServerAPI\Method\GetSystemInfo', array('parseResponse'));
	    $action->expects($this->once())->method('parseResponse')->with($response)->will($this->returnValue(new SystemInfo()));
	    
	    $httpful = $this->getMockBuilder('\Httpful\Request', array('addHeader', 'send'))->disableOriginalConstructor()->getMock();
	    $httpful->expects($this->any())->method('addHeader');
	    $httpful->expects($this->once())->method('send')->will($this->returnValue($response));
	    
 	    $request->setAction($action);
 	    $this->assertEquals($request->send($httpful), new SystemInfo());
	}
	
	/*public function testSendWithPostAction()
	{
	    $this->markTestSkipped('Damn, public method expects in Httpful - uncool for mocking...');
	    $response = new \stdClass();
	    $response->code = 200;
	     
	    $request = Startup::getRequest();
	    $action = $this->getMock('\ZendServerAPI\Method\ClusterRemoveServer', array('parseResponse'), array(2));
	    $action->expects($this->once())->method('parseResponse')->with($response)->will($this->returnValue(new ServerInfo()));
	     
	    $httpful = $this->getMockBuilder('\Httpful\Request', array('addHeader', 'send'))->disableOriginalConstructor()->getMock();
	    $httpful->expects($this->any())->method('addHeader');
	    $httpful->expects($this->once())->method('send')->will($this->returnValue($response));
	     
	    $request->setAction($action);
	    $this->assertEquals($request->send($httpful), new ServerInfo());
	}*/

	/**
	 * @expectedException \ZendServerAPI\Exception\ServerSide
	 * @expectedExceptionMessage serverNotLicensed: Zend Server Cluster Manager is not licensed.
	 * @expectedExceptionCode 500
	 */
	public function testSendWithErrorcode500()
	{
	    $request = Startup::getRequest();
	    $action = $this->getMock('\ZendServerAPI\Method\ClusterRemoveServer', array('parseResponse'), array(2));
	    $httpful = $this->getMockBuilder('\Httpful\Request', array('addHeader', 'send'))->disableOriginalConstructor()->getMock();
	     
	    $body = <<<EOF
            <zendServerAPIResponse xmlns="http://www.zend.com/server/api/1.0">
	            <requestData>
		            <apiKeyName><![CDATA[api]]></apiKeyName>
		            <method><![CDATA[getSystemInfo]]></method>
	            </requestData>
	            <errorData>
	                <errorCode>serverNotLicensed</errorCode>
	                <errorMessage><![CDATA[Zend Server Cluster Manager is not licensed.]]></errorMessage>
                </errorData>
		    </zendServerAPIResponse>
EOF;
	    
	    $xmlResponse = new \Httpful\Response($body, "HTTP/1.1 200 OK
Content-Type: application/xml
Connection: keep-alive
Transfer-Encoding: chunked\r\n", $httpful);
	    $xmlResponse->code = 500;
	    $httpful->expects($this->any())->method('addHeader');
	    $httpful->expects($this->once())->method('send')->will($this->returnValue($xmlResponse));
	     
	    $request->setAction($action);
	    $request->send($httpful);
	}
	
	/**
	 * @expectedException \ZendServerAPI\Exception\ClientSide
	 * @expectedExceptionMessage authError: Incorrect signature
	 * @expectedExceptionCode 400
	 */
	public function testSendWithErrorcode400()
	{
	    $request = Startup::getRequest();
	    $action = $this->getMock('\ZendServerAPI\Method\ClusterRemoveServer', array('parseResponse'), array(2));
	    $httpful = $this->getMockBuilder('\Httpful\Request', array('addHeader', 'send'))->disableOriginalConstructor()->getMock();
	    
	    $body = <<<EOF
        	<zendServerAPIResponse xmlns="http://www.zend.com/server/api/1.0">
	            <requestData>
		            <apiKeyName><![CDATA[api]]></apiKeyName>
		            <method><![CDATA[getSystemInfo]]></method>
	            </requestData>
	            <errorData>
	                <errorCode>authError</errorCode>
	                <errorMessage><![CDATA[Incorrect signature]]></errorMessage>
                </errorData>
            </zendServerAPIResponse>    
EOF;
	    $xmlResponse = new \Httpful\Response($body, "HTTP/1.1 200 OK
Content-Type: application/xml
Connection: keep-alive
Transfer-Encoding: chunked\r\n", $httpful);
	    $xmlResponse->code = 400;
	    $httpful->expects($this->any())->method('addHeader');
	    $httpful->expects($this->once())->method('send')->will($this->returnValue($xmlResponse));
	    
	    $request->setAction($action);
	    $request->send($httpful);
	}
	
}

