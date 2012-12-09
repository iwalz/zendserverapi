<?php

namespace ZendServerAPITest;

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
        $server = new Server("example62");
        $server->setConfigFile(__DIR__.'/../_files/config/config.php');
        $sm = $server->getServiceManager();
        $conf = $server->getServiceManagerConfig()->registerAPIVersionFactories();
        $this->assertTrue($sm->get('clusterGetServerStatus') instanceof ClusterGetServerStatus);
    }
    
    public function testForCorrectLoggerSetup()
    {
        $server = new Server("example62");
        $server->setConfigFile(__DIR__.'/../_files/config/config.php');
        $sm = $server->getServiceManager();
        
        if($server->canConnect())
            var_dump($server->getSystemInfo());
        
        $this->assertTrue($sm->get('logger')->getWriters()->current() instanceof \Zend\Log\Writer\Stream);
        $server->disableLogging();
        $this->assertTrue($sm->get('logger')->getWriters()->current() instanceof \Zend\Log\Writer\Mock);
        $server->enableLogging();
        $this->assertTrue($sm->get('logger')->getWriters()->current() instanceof \Zend\Log\Writer\Stream);
    }
    
}

