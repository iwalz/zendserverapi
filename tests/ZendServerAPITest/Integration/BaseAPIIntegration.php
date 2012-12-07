<?php

namespace ZendServerAPITest\Integration;

abstract class BaseAPIIntegration extends \PHPUnit_Framework_TestCase
{
    static $mockDataProvider = null;
    
    const MOCK = 'mock';
    const LOCAL = 'local';
    const CLOUD = 'cloud';
    const CLUSTER = 'cluster';
    
    protected $state = null;
    protected $object = null;
    protected $mockObject = null;
    
    protected function setUp ()
    {
        parent::setUp();
        $this->mockObject = new \ZendService\ZendServerAPI\Server();
    }

    protected function tearDown ()
    {
        parent::tearDown();
    }

    /**
     * @dataProvider mockProvider
     */
    public function testAgainstMock($method, $expectedObject, $params)
    {
        $adapter = new \Zend\Http\Client\Adapter\Test();
        $response = file_get_contents(getcwd().'/ZendServerAPITest/Integration/TestAssets/'.$method);
        $adapter->setResponse($response);
        $this->mockObject->getRequest()->setClientAdapter($adapter);
        $returnValue = call_user_method_array($method, $this->mockObject, $params);
        
        $this->assertEquals($expectedObject, $returnValue);
    }

    abstract function mockProvider();
}

