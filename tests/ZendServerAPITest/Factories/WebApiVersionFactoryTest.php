<?php
namespace ZendServerAPITest;

use ZendServerAPI\Method\ApplicationUpdate;

use ZendServerAPI\Method\ApplicationDeploy;

use ZendServerAPI\Startup;

/**
 * test case.
 */
class WebApiVersionFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testWebApiVersionFactory()
    {
        $request = Startup::getRequest();
        $config = $request->getConfig();
        $webApiVersionFactory = new \ZendServerAPI\Factories\WebApiVersionFactory();
        $webApiVersionFactory->setConfig($config);
        
        $this->assertEquals($config->getApiVersion(), \ZendServerAPI\Version::ZS56);
        
        $retFactory = $webApiVersionFactory->getCommandFactory();
        $this->assertInstanceOf('\ZendServerAPI\Factories\ApiVersion12CommandFactory', $retFactory);
        $this->assertEquals('ZendServerAPI\Factories\ApiVersion12CommandFactory', get_class($retFactory));
        
        $clusterAddServer = $retFactory->factory('clusterAddServer', 'example62', 'http://example62:10081/ZendServer', 'test');
        $this->assertInstanceOf('\ZendServerAPI\Method\ClusterAddServer', $clusterAddServer);
        
        $clusterRemoveServer = $retFactory->factory('clusterRemoveServer', '1', true);
        $this->assertInstanceOf('\ZendServerAPI\Method\ClusterRemoveServer', $clusterRemoveServer);
        $this->assertEquals('serverId=1&force=TRUE', $clusterRemoveServer->getContent());
        
        $clusterEnableServer = $retFactory->factory('clusterEnableServer', '1');
        $this->assertInstanceOf('\ZendServerAPI\Method\ClusterEnableServer', $clusterEnableServer);
        $this->assertEquals('serverId=1', $clusterEnableServer->getContent());
        
        $clusterDisableServer = $retFactory->factory('clusterDisableServer', '1');
        $this->assertInstanceOf('\ZendServerAPI\Method\ClusterDisableServer', $clusterDisableServer);
        $this->assertEquals('serverId=1', $clusterDisableServer->getContent());
        
        $clusterGetServerStatus = $retFactory->factory('clusterGetServerStatus', array(1));
        $this->assertInstanceOf('\ZendServerAPI\Method\ClusterGetServerStatus', $clusterGetServerStatus);
        
        $getSystemInfo = $retFactory->factory('getSystemInfo');
        $this->assertInstanceOf('\ZendServerAPI\Method\GetSystemInfo', $getSystemInfo);
    }
    
    public function testWebApi11VersionFactory()
    {
        $request = Startup::getRequest("ZS55");
        $config = $request->getConfig();
        $webApiVersionFactory = new \ZendServerAPI\Factories\WebApiVersionFactory();
        $webApiVersionFactory->setConfig($config);
    
        $this->assertEquals($config->getApiVersion(), \ZendServerAPI\Version::ZS55);
    
        $retFactory = $webApiVersionFactory->getCommandFactory();
        $this->assertInstanceOf('\ZendServerAPI\Factories\ApiVersion11CommandFactory', $retFactory);
        $this->assertEquals('ZendServerAPI\Factories\ApiVersion11CommandFactory', get_class($retFactory));
    
        $applicationDeploy = $retFactory->factory('applicationDeploy', 'mypackage.zpk', 'http://www.test.com');
        $this->assertInstanceOf('\ZendServerAPI\Method\ApplicationDeploy', $applicationDeploy);
        
        $applicationRemove = $retFactory->factory('applicationRemove', '1');
        $this->assertInstanceOf('\ZendServerAPI\Method\ApplicationRemove', $applicationRemove);

        $applicationUpdate = $retFactory->factory('applicationUpdate', '1', 'mypackage.zpk');
        $this->assertInstanceOf('\ZendServerAPI\Method\ApplicationUpdate', $applicationUpdate);
        
        $applicationSynchronize = $retFactory->factory('applicationSynchronize', '1');
        $this->assertInstanceOf('\ZendServerAPI\Method\ApplicationSynchronize', $applicationSynchronize);
        
        $applicationRollback = $retFactory->factory('applicationRollback', '1');
        $this->assertInstanceOf('\ZendServerAPI\Method\ApplicationRollback', $applicationRollback);
        
        $applicationGetStatus = $retFactory->factory('applicationGetStatus', array('1'));
        $this->assertInstanceOf('\ZendServerAPI\Method\ApplicationGetStatus', $applicationGetStatus);
    }
    
    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage The method applicationUpdate is not available
     */
    public function testWebApiMethodFromNewerApiVersion()
    {
        $request = Startup::getRequest("ZS51");
        $config = $request->getConfig();
        $webApiVersionFactory = new \ZendServerAPI\Factories\WebApiVersionFactory();
        $webApiVersionFactory->setConfig($config);
        
        $this->assertEquals($config->getApiVersion(), \ZendServerAPI\Version::ZS51);
        
        $retFactory = $webApiVersionFactory->getCommandFactory();
        $applicationUpdate = $retFactory->factory('applicationUpdate', '1', 'mypackage.zpk');
        $this->assertInstanceOf('\ZendServerAPI\Method\ApplicationUpdate', $applicationUpdate);
    }
    
    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage The method test is not available
     */
    public function testWebApiIncorrectCommandException()
    {
        $request = Startup::getRequest();
        $config = $request->getConfig();
        $webApiVersionFactory = new \ZendServerAPI\Factories\WebApiVersionFactory();
        $webApiVersionFactory->setConfig($config);
        
        $retFactory = $webApiVersionFactory->getCommandFactory();
        
        $retFactory->factory('test');
    }
    
    public function testWebApiVersion10Factory()
    {
        $request = Startup::getRequest("ZS51");
        $config = $request->getConfig();
        $webApiVersionFactory = new \ZendServerAPI\Factories\WebApiVersionFactory();
        $webApiVersionFactory->setConfig($config);
        
        $retFactory = $webApiVersionFactory->getCommandFactory();
        $this->assertEquals('ZendServerAPI\Factories\ApiVersion10CommandFactory', get_class($retFactory));
    }
    
    public function testWebApiVersion11Factory()
    {
        $request = Startup::getRequest("ZS55");
        $config = $request->getConfig();
        $webApiVersionFactory = new \ZendServerAPI\Factories\WebApiVersionFactory();
        $webApiVersionFactory->setConfig($config);
    
        $retFactory = $webApiVersionFactory->getCommandFactory();
        $this->assertEquals('ZendServerAPI\Factories\ApiVersion11CommandFactory', get_class($retFactory));
    }
    
}

