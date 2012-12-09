<?php
namespace ZendServerAPITest;

use \ZendService\ZendServerAPI\Method\ApplicationUpdate;

use \ZendService\ZendServerAPI\Method\ApplicationDeploy;

use \ZendService\ZendServerAPI\Startup;

/**
 * test case.
 */
class WebApiVersionFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->markTestSkipped();
    }
    
    public function testWebApiVersionFactory()
    {
        $request = Startup::getRequest();
        $config = $request->getConfig();
        $webApiVersionFactory = new \ZendService\ZendServerAPI\Factories\WebApiVersionFactory();
        $webApiVersionFactory->setConfig($config);
        
        $this->assertEquals($config->getApiVersion(), \ZendService\ZendServerAPI\Version::ZS56);
        
        $retFactory = $webApiVersionFactory->getCommandFactory();
        $this->assertInstanceOf('\ZendService\ZendServerAPI\Factories\ApiVersion12CommandFactory', $retFactory);
        $this->assertEquals('ZendService\ZendServerAPI\Factories\ApiVersion12CommandFactory', get_class($retFactory));
        
        $clusterAddServer = $retFactory->factory('clusterAddServer', 'example62', 'http://example62:10081/ZendServer', 'test');
        $this->assertInstanceOf('\ZendService\ZendServerAPI\Method\ClusterAddServer', $clusterAddServer);
        
        $clusterRemoveServer = $retFactory->factory('clusterRemoveServer', '1', true);
        $this->assertInstanceOf('\ZendService\ZendServerAPI\Method\ClusterRemoveServer', $clusterRemoveServer);
        $this->assertEquals('serverId=1&force=TRUE', $clusterRemoveServer->getContent());
        
        $clusterEnableServer = $retFactory->factory('clusterEnableServer', '1');
        $this->assertInstanceOf('\ZendService\ZendServerAPI\Method\ClusterEnableServer', $clusterEnableServer);
        $this->assertEquals('serverId=1', $clusterEnableServer->getContent());
        
        $clusterDisableServer = $retFactory->factory('clusterDisableServer', '1');
        $this->assertInstanceOf('\ZendService\ZendServerAPI\Method\ClusterDisableServer', $clusterDisableServer);
        $this->assertEquals('serverId=1', $clusterDisableServer->getContent());
        
        $clusterGetServerStatus = $retFactory->factory('clusterGetServerStatus', array(1));
        $this->assertInstanceOf('\ZendService\ZendServerAPI\Method\ClusterGetServerStatus', $clusterGetServerStatus);
        
        $getSystemInfo = $retFactory->factory('getSystemInfo');
        $this->assertInstanceOf('\ZendService\ZendServerAPI\Method\GetSystemInfo', $getSystemInfo);
    }
    
    public function testWebApi11VersionFactory()
    {
        $request = Startup::getRequest("ZS55");
        $config = $request->getConfig();
        $webApiVersionFactory = new \ZendService\ZendServerAPI\Factories\WebApiVersionFactory();
        $webApiVersionFactory->setConfig($config);
    
        $this->assertEquals($config->getApiVersion(), \ZendService\ZendServerAPI\Version::ZS55);
    
        $retFactory = $webApiVersionFactory->getCommandFactory();
        $this->assertInstanceOf('\ZendService\ZendServerAPI\Factories\ApiVersion11CommandFactory', $retFactory);
        $this->assertEquals('ZendService\ZendServerAPI\Factories\ApiVersion11CommandFactory', get_class($retFactory));
    
        $applicationDeploy = $retFactory->factory('applicationDeploy', 'mypackage.zpk', 'http://www.test.com');
        $this->assertInstanceOf('\ZendService\ZendServerAPI\Method\ApplicationDeploy', $applicationDeploy);
        
        $applicationRemove = $retFactory->factory('applicationRemove', '1');
        $this->assertInstanceOf('\ZendService\ZendServerAPI\Method\ApplicationRemove', $applicationRemove);

        $applicationUpdate = $retFactory->factory('applicationUpdate', '1', 'mypackage.zpk');
        $this->assertInstanceOf('\ZendService\ZendServerAPI\Method\ApplicationUpdate', $applicationUpdate);
        
        $applicationSynchronize = $retFactory->factory('applicationSynchronize', '1');
        $this->assertInstanceOf('\ZendService\ZendServerAPI\Method\ApplicationSynchronize', $applicationSynchronize);
        
        $applicationRollback = $retFactory->factory('applicationRollback', '1');
        $this->assertInstanceOf('\ZendService\ZendServerAPI\Method\ApplicationRollback', $applicationRollback);
        
        $applicationGetStatus = $retFactory->factory('applicationGetStatus', array('1'));
        $this->assertInstanceOf('\ZendService\ZendServerAPI\Method\ApplicationGetStatus', $applicationGetStatus);
    }
    
    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage The method applicationUpdate is not available
     */
    public function testWebApiMethodFromNewerApiVersion()
    {
        $request = Startup::getRequest("ZS51");
        $config = $request->getConfig();
        $webApiVersionFactory = new \ZendService\ZendServerAPI\Factories\WebApiVersionFactory();
        $webApiVersionFactory->setConfig($config);
        
        $this->assertEquals($config->getApiVersion(), \ZendService\ZendServerAPI\Version::ZS51);
        
        $retFactory = $webApiVersionFactory->getCommandFactory();
        $applicationUpdate = $retFactory->factory('applicationUpdate', '1', 'mypackage.zpk');
        $this->assertInstanceOf('\ZendService\ZendServerAPI\Method\ApplicationUpdate', $applicationUpdate);
    }
    
    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage The method test is not available
     */
    public function testWebApiIncorrectCommandException()
    {
        $request = Startup::getRequest();
        $config = $request->getConfig();
        $webApiVersionFactory = new \ZendService\ZendServerAPI\Factories\WebApiVersionFactory();
        $webApiVersionFactory->setConfig($config);
        
        $retFactory = $webApiVersionFactory->getCommandFactory();
        
        $retFactory->factory('test');
    }
    
    public function testWebApiVersion10Factory()
    {
        $request = Startup::getRequest("ZS51");
        $config = $request->getConfig();
        $webApiVersionFactory = new \ZendService\ZendServerAPI\Factories\WebApiVersionFactory();
        $webApiVersionFactory->setConfig($config);
        
        $retFactory = $webApiVersionFactory->getCommandFactory();
        $this->assertEquals('ZendService\ZendServerAPI\Factories\ApiVersion10CommandFactory', get_class($retFactory));
    }
    
    public function testWebApiVersion11Factory()
    {
        $request = Startup::getRequest("ZS55");
        $config = $request->getConfig();
        $webApiVersionFactory = new \ZendService\ZendServerAPI\Factories\WebApiVersionFactory();
        $webApiVersionFactory->setConfig($config);
    
        $retFactory = $webApiVersionFactory->getCommandFactory();
        $this->assertEquals('ZendService\ZendServerAPI\Factories\ApiVersion11CommandFactory', get_class($retFactory));
    }
    
}

