<?php

/**
 * test case.
 */
class ProductionTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $server = new \ZendServerAPI\Server("prod");
        try {
            $server->clusterGetServerStatus();
        } catch(\Exception $e) {
            $this->markTestSkipped("No ZendSerer available for production testing");
        }
    }
    
    public function testAddRemoveServer()
    {
        $server = new \ZendServerAPI\Server("prod");
        $serversList = $server->clusterGetServerStatus();
        foreach($serversList->getServerInfos() as $serverInfo)
        {
            $server->clusterRemoveServer($serverInfo->getId(), true);
        }
        
        $serversList = $server->clusterGetServerStatus();
        $this->assertEquals(array(), $serversList->getServerInfos());
        
        $server->clusterAddServer('zendserver2', 'http://192.168.2.4:10081/ZendServer', 'test', false, true);
        $serverInfo = $server->waitForStableState('zendserver2');
        $this->assertEquals("zendserver2", $serverInfo->getName());
        $this->assertEquals("OK", $serverInfo->getStatus());
    }
    
    public function testEnableDisableServer()
    {
        $server = new \ZendServerAPI\Server("prod");
        $serversList = $server->clusterGetServerStatus();
        if($serversList->getServerInfos() === array())
            $this->markTestSkipped("No servers in the cluster - skipped enable/disable test");
        $serverInfo = $serversList->getFirst();
        
        $serverInfo = $server->clusterDisableServer($serverInfo->getId());
        $this->assertEquals("disabled", $serverInfo->getStatus());
        
        $serverInfo = $server->clusterEnableServer($serverInfo->getId());
        $serversList = $server->restartPhp(array($serverInfo->getId()));
        $serverInfo = $serversList->getServerStatusById($serverInfo->getId());
        $serverInfo = $server->waitForStableState($serverInfo->getId());
        
        $this->assertEquals("OK", $serverInfo->getStatus());
    }
    
    
    public function testProdConfiguration()
    {
        $configuration = new \ZendServerAPI\Configuration("prod");
//         var_dump($configuration->configurationExport());
    }
}

