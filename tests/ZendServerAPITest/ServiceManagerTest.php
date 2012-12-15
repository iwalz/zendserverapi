<?php

namespace ZendServerAPITest;

use ZendService\ZendServerAPI\Method\ApplicationGetStatus;

use ZendService\ZendServerAPI\Method\ClusterAddServer;

use ZendService\ZendServerAPI\Method\ApplicationDeploy;

use ZendService\ZendServerAPI\Deployment;

use ZendService\ZendServerAPI\ServiceManagerConfig;

use ZendService\ZendServerAPI\Method\ClusterGetServerStatus;
use ZendService\ZendServerAPI\Server;
use Zend\ServiceManager\ServiceManager;

/**
 * test case.
 */
class ServiceManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testForAPIVersion10CommandsInSM()
    {
        $server = new Server("ZS51");
        $server->setConfigFile(__DIR__.'/../_files/config/config.php');
        $sm = $server->getServiceManager();
        $this->assertTrue($sm->get('clusterGetServerStatus') instanceof ClusterGetServerStatus);
        $this->assertTrue($sm->get('clusterAddServer') instanceof ClusterAddServer);
    }
    
    public function testForCorrectLoggerSetup()
    {
        ServiceManagerConfig::enableCentralLogging();
        $server = new Server("example62");
        $server->setConfigFile(__DIR__.'/../_files/config/config.php');
        $sm = $server->getServiceManager();
        
        $this->assertTrue($sm->get('logger')->getWriters()->current() instanceof \Zend\Log\Writer\Stream);
        $server->disableLogging();
        $this->assertTrue($sm->get('logger')->getWriters()->current() instanceof \Zend\Log\Writer\Mock);
        $server->enableLogging();
        $this->assertTrue($sm->get('logger')->getWriters()->current() instanceof \Zend\Log\Writer\Stream);
        ServiceManagerConfig::disableCentralLogging();
    }
    
    public function testWebApiVersionFactory()
    {
        $server = new Server();
        $sm = $server->getServiceManager();
        $config = $sm->get("config");
    
        $this->assertEquals($config->getApiVersion(), \ZendService\ZendServerAPI\Version::ZS56);
    
        $clusterAddServer = $sm->get('clusterAddServer');
        $this->assertInstanceOf('\ZendService\ZendServerAPI\Method\ClusterAddServer', $clusterAddServer);
    
        $clusterRemoveServer = $sm->get('clusterRemoveServer');
        $this->assertInstanceOf('\ZendService\ZendServerAPI\Method\ClusterRemoveServer', $clusterRemoveServer);
    
        $clusterEnableServer = $sm->get('clusterEnableServer');
        $this->assertInstanceOf('\ZendService\ZendServerAPI\Method\ClusterEnableServer', $clusterEnableServer);
    
        $clusterDisableServer = $sm->get('clusterDisableServer');
        $this->assertInstanceOf('\ZendService\ZendServerAPI\Method\ClusterDisableServer', $clusterDisableServer);
    
        $clusterGetServerStatus = $sm->get('clusterGetServerStatus');
        $this->assertInstanceOf('\ZendService\ZendServerAPI\Method\ClusterGetServerStatus', $clusterGetServerStatus);
    
        $getSystemInfo = $sm->get('getSystemInfo');
        $this->assertInstanceOf('\ZendService\ZendServerAPI\Method\GetSystemInfo', $getSystemInfo);
    }
    
    public function testWebApi11VersionFactory()
    {
        $server = new Server("ZS55");
        $sm = $server->getServiceManager();
        $config = $sm->get("config");
    
        $this->assertEquals($config->getApiVersion(), \ZendService\ZendServerAPI\Version::ZS55);
    
        $applicationDeploy = $sm->get('applicationDeploy');
        $this->assertInstanceOf('\ZendService\ZendServerAPI\Method\ApplicationDeploy', $applicationDeploy);
    
        $applicationRemove = $sm->get('applicationRemove');
        $this->assertInstanceOf('\ZendService\ZendServerAPI\Method\ApplicationRemove', $applicationRemove);
    
        $applicationUpdate = $sm->get('applicationUpdate');
        $this->assertInstanceOf('\ZendService\ZendServerAPI\Method\ApplicationUpdate', $applicationUpdate);
    
        $applicationSynchronize = $sm->get('applicationSynchronize');
        $this->assertInstanceOf('\ZendService\ZendServerAPI\Method\ApplicationSynchronize', $applicationSynchronize);
    
        $applicationRollback = $sm->get('applicationRollback');
        $this->assertInstanceOf('\ZendService\ZendServerAPI\Method\ApplicationRollback', $applicationRollback);
    
        $applicationGetStatus = $sm->get('applicationGetStatus');
        $this->assertInstanceOf('\ZendService\ZendServerAPI\Method\ApplicationGetStatus', $applicationGetStatus);
    }
    
    /**
     * @expectedException \Zend\ServiceManager\Exception\ServiceNotFoundException
     * @expectedExceptionMessage Zend\ServiceManager\ServiceManager::get was unable to fetch or create an instance for applicationUpdate
     */
    public function testWebApiMethodFromNewerApiVersion()
    {
        $server = new Server("ZS51");
        $sm = $server->getServiceManager();
        $config = $sm->get("config");
    
        $this->assertEquals($config->getApiVersion(), \ZendService\ZendServerAPI\Version::ZS51);
    
        $applicationUpdate = $sm->get('applicationUpdate');
        $this->assertInstanceOf('\ZendService\ZendServerAPI\Method\ApplicationUpdate', $applicationUpdate);
    }
    
    /**
     * @expectedException \Zend\ServiceManager\Exception\ServiceNotFoundException
     * @expectedExceptionMessage Zend\ServiceManager\ServiceManager::get was unable to fetch or create an instance for test
     */
    public function testWebApiIncorrectCommandException()
    {
        $server = new Server();
        $sm = $server->getServiceManager();
        $config = $sm->get("config");
    
        $sm->get('test');
    }
    
    public function testWebApiVersion10Factory()
    {
        $server = new Server("ZS51");
        $sm = $server->getServiceManager();
        $config = $sm->get("config");
    
    }
    
    public function testWebApiVersion11Factory()
    {
        $server = new Server("ZS55");
        $sm = $server->getServiceManager();
        $config = $sm->get("config");
    
        $this->assertEquals($config->getApiVersion(), \ZendService\ZendServerAPI\Version::ZS55);
    
    }
    
    public function testDeploy()
    {
        $server = new Server("example62");
        $server->setConfigFile(__DIR__.'/../_files/config/config.php');
        $sm = $server->getServiceManager();
        $this->assertTrue($sm->get('applicationGetStatus') instanceof ApplicationGetStatus);
    }
    
}

