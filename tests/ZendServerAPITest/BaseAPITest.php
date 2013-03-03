<?php

use \ZendService\ZendServerAPI\Request;

use ZendService\ZendServerAPI\BaseAPI;
use ZendService\ZendServerAPI\Deployment;

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * test case.
 */
class BaseAPITest extends PHPUnit_Framework_TestCase
{
    public function testGettersAndSetters()
    {
        $baseAPI = new BaseAPI();
        $request = new Request();
        
        $baseAPI->setRequest($request);
        
        $this->assertSame($request, $baseAPI->getRequest());
    }
    
    public function testFirstEventGroupsIdByIssueId()
    {
        $monitor = new \ZendService\ZendServerAPI\Monitor("example62");
        if(!$monitor->canConnect())
            $this->markTestSkipped("Can't connect to server");
    
        $list = $monitor->monitorGetIssuesListByPredefinedFilter('All Events');
        $issue = $list->getIterator()->current();
    
        $detail = $monitor->monitorGetEventGroupDetails($issue->getId());
        $this->assertTrue($detail instanceof \ZendService\ZendServerAPI\DataTypes\EventsGroupDetails);
    }

    /**
     * @runInSeparateProcess
     * @expectedException \RuntimeException
     * @expectedExceptionMessage /var/www/foo not found
     */
    public function testConfigNotFound()
    {
        \ZendService\ZendServerAPI\PluginManager::setConfigFile('/var/www/foo');
        $deployment = new Deployment();
        $deployment->applicationGetStatus();
    }

    /**
     * @runInSeparateProcess
     */
    public function testConfigParameter()
    {
        \ZendService\ZendServerAPI\PluginManager::setConfigFile('/var/www/foo');
        $deployment = new Deployment(
            array(
                'version' => \ZendService\ZendServerAPI\Version::ZS56,
                'name' => 'api',
                'key' => 'c88446d17dbef49273e9463bc5fc81be999bc54670ee2deb483e93acb6e9b2e9',
                'host' => 'iwalz.my.phpcloud.com',
                'port' => 10082,
                'proxyHost' => 'proxy',
                'proxyPort' => 8000
            )
        );
        $adapter = new \Zend\Http\Client\Adapter\Test();
        $response = file_get_contents(getcwd().'/ZendServerAPITest/Integration/TestAssets/deployment/applicationGetStatus');
        $adapter->setResponse($response);
        $deployment->getRequest()->setClientAdapter($adapter);
        $deployment->applicationGetStatus();

        $config = $deployment->getRequest()->getConfig();
        $this->assertEquals(\ZendService\ZendServerAPI\Version::ZS56, $config->getApiVersion());
        $this->assertEquals('c88446d17dbef49273e9463bc5fc81be999bc54670ee2deb483e93acb6e9b2e9', $config->getApiKey()->getKey());
        $this->assertEquals('api', $config->getApiKey()->getName());
        $this->assertEquals('iwalz.my.phpcloud.com', $config->getHost());
        $this->assertEquals(10082, $config->getPort());
        $this->assertEquals('proxy', $config->getProxyHost());
        $this->assertEquals(8000, $config->getProxyPort());
    }
}

