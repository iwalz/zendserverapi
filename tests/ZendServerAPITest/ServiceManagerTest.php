<?php

namespace ZendServerAPITest;

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
        $server = new Server();
        $sm = $server->getServiceManager();
        $this->assertTrue($sm->get('clusterGetServerStatus') instanceof ClusterGetServerStatus);
    }
}

