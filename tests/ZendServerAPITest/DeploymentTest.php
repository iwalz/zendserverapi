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
        require_once 'ZendServerAPITest/Method/ApplicationGetStatusTest.php';
        $responseStub->expects($this->once())->method('getBody')->will($this->returnValue(ApplicationGetStatusTest::getResponse()));
        
        $clientStub = $this->getMock('\Guzzle\Http\Client', array('send'));
        $clientStub->expects($this->once())->method('send')->will($this->returnValue($responseStub));
        
        $deployment = new \ZendServerAPI\Deployment();
        $deployment->setClient($clientStub);
        $result = $deployment->applicationGetStatus(array(1,2));
        $this->assertInstanceOf('\ZendServerAPI\DataTypes\ApplicationList', $result);
    }

    public function testApplicationGetStatusAgainstProduction()
    {
        try {
            $deployment = new \ZendServerAPI\Deployment("example62");
            $deploymentStatus = $deployment->applicationGetStatus();
        } catch(\Exception $e) {
            $this->markTestSkipped();
        }
        
        $this->assertInstanceOf('\ZendServerAPI\DataTypes\ApplicationList', $deploymentStatus);
    }
    
    public function testApplicationDeploy()
    {
        $deployment = new \ZendServerAPI\Deployment("example62");
        if(!$deployment->canConnect())
            $this->markTestSkipped();
        
        $apps = $deployment->applicationGetStatus();
        foreach($apps->getApplicationInfos() as $applicationInfo)
        {
            $deployment->applicationRemove($applicationInfo->getId());
        }
        
        $deploy = $deployment->applicationDeploy(
                __DIR__.'/../_files/example2.zpk', 
                "http://test2.com", 
                true, 
                false, 
                'Simple test app', 
                false, 
                array(
                    'locale' => 'GMT',
                    'db_host' => 'localhost'        
                )
        );
        $deployment->waitForStableState($deploy->getId());
        $this->assertInstanceOf('\ZendServerAPI\DataTypes\ApplicationInfo', $deploy);
        $deployment->applicationRemove($deploy->getId());
        $deployment->waitForRemoved($deploy->getId());
            
    }
    
    public function testWaitForMethods()
    {
        $deployment = new \ZendServerAPI\Deployment("example62");
        if(!$deployment->canConnect())
            $this->markTestSkipped();
        
        $deploy = $deployment->applicationDeploy(
                __DIR__.'/../_files/example2.zpk',
                "http://testwait.com",
                true,
                false,
                'Simple test app for waiting function',
                false,
                array(
                        'locale' => 'GMT',
                        'db_host' => 'localhost'
                )
        );
        $result = $deployment->waitForStableState($deploy->getId());
        
        $this->assertEquals("deployed", $result->getStatus());
        $deployment->applicationRemove($result->getId());
        $retVal = $deployment->waitForRemoved($result->getId());
        $this->assertTrue($retVal);
    }
}

