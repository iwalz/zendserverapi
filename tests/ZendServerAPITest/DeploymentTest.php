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
}

