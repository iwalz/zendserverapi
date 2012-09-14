<?php
namespace ZendServerAPITest;

use ZendServerAPI\Request;

use ZendServerAPI\Deployment;

class DeploymentTest extends \PHPUnit_Framework_TestCase
{

    protected function setUp ()
    {
        
    }
    
    public function testConstructorInjection()
    {
        $deployment = new Deployment("example62");
        $config = $deployment->getRequest()->getConfig();
        $request = new Request();
        $request->setConfig($config);
        $deployment->setRequest($request);
        
        $this->assertSame($request, $deployment->getRequest());
        $this->assertInstanceOf('\ZendServerAPI\Config', $deployment->getRequest()->getConfig());
        $this->assertInstanceOf('\ZendServerAPI\ApiKey', $deployment->getRequest()->getConfig()->getApiKey());
    }
    
    public function testApplicationGetStatus()
    {
        $responseStub = $this->getMock('\Guzzle\Http\Message\Response', array('getBody'), array(200));
        $responseStub->expects($this->once())->method('getBody')->will($this->returnValue(ApplicationGetStatusTest::getResponse()));
        
        $clientStub = $this->getMock('\Guzzle\Http\Client', array('send'));
        $clientStub->expects($this->once())->method('send')->will($this->returnValue($responseStub));
        
        $deployment = new \ZendServerAPI\Deployment();
        $deployment->setClient($clientStub);
        $result = $deployment->applicationGetStatus(array(1,2));
        $this->assertInstanceOf('\ZendServerAPI\DataTypes\ApplicationList', $result);
    }
    
}

