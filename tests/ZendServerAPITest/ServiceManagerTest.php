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
    
    public function testDeploy()
    {
        $server = new Server("example62");
        $server->setConfigFile(__DIR__.'/../_files/config/config.php');
        $sm = $server->getServiceManager();
        $this->assertTrue($sm->get('applicationGetStatus') instanceof ApplicationGetStatus);
    }
    
}

