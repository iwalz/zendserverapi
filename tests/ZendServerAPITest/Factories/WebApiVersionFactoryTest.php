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
        $method = $retFactory::factory('clusterAddServer', 'example62', 'http://example62:10081/ZendServer', 'test');
        
        $this->assertInstanceOf('\ZendServerAPI\Method\ClusterAddServer', $method);
    }
}

