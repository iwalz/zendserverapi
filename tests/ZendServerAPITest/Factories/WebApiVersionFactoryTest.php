<?php
namespace ZendServerAPITest;

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
        
        $clusterAddServer = $retFactory::factory('clusterAddServer', 'example62', 'http://example62:10081/ZendServer', 'test');
        $this->assertInstanceOf('\ZendServerAPI\Method\ClusterAddServer', $clusterAddServer);
        
        $clusterRemoveServer = $retFactory::factory('clusterRemoveServer', '1', true);
        $this->assertInstanceOf('\ZendServerAPI\Method\ClusterRemoveServer', $clusterRemoveServer);
        $this->assertEquals('serverId=1&force=TRUE', $clusterRemoveServer->getContent());
        
        $clusterEnableServer = $retFactory::factory('clusterEnableServer', '1');
        $this->assertInstanceOf('\ZendServerAPI\Method\ClusterEnableServer', $clusterEnableServer);
        $this->assertEquals('serverId=1', $clusterEnableServer->getContent());
        
        $clusterDisableServer = $retFactory::factory('clusterDisableServer', '1');
        $this->assertInstanceOf('\ZendServerAPI\Method\ClusterDisableServer', $clusterDisableServer);
        $this->assertEquals('serverId=1', $clusterDisableServer->getContent());
        
        $clusterGetServerStatus = $retFactory::factory('clusterGetServerStatus', array(1));
        $this->assertInstanceOf('\ZendServerAPI\Method\ClusterGetServerStatus', $clusterGetServerStatus);
        
        $getSystemInfo = $retFactory::factory('getSystemInfo');
        $this->assertInstanceOf('\ZendServerAPI\Method\GetSystemInfo', $getSystemInfo);
    }
}

