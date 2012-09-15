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
            $installed = false;
            foreach($apps->getApplicationInfos() as $applicationInfo)
            {
                if($applicationInfo->getBaseUrl() == "http://test2.com")
                {
                    $installed = true;
                }
            }
            if($installed)
                $this->setExpectedException('\ZendServerAPI\Exception\ClientSide', 'baseUrlConflict: This application has already been installed', 409);
            
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
            $this->assertInstanceOf('\ZendServerAPI\DataTypes\ApplicationInfo', $deploy);
    }
}

