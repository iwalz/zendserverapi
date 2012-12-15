<?php

namespace ZendServerAPITest\Integration;

use ZendService\ZendServerAPI\Server;

abstract class BaseAPIIntegration extends \PHPUnit_Framework_TestCase
{
    static $mockDataProvider = null;
    static $localDataProvider = null;
    
    const MOCK = 'mock';
    const LOCAL = 'local';
    const CLOUD = 'cloud';
    const CLUSTER = 'cluster';
    
    /**
     * @var \ZendService\ZendServerAPI\Server
     */
    protected $mockObject = null;
    /**
     * @var \ZendService\ZendServerAPI\Server
     */
    protected $object = null;
    
    protected function setUp ()
    {
        parent::setUp();
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
        $response = file_get_contents(getcwd().'/ZendServerAPITest/Integration/TestAssets/'.$this->getSection().'/'.$method);
        $adapter->setResponse($response);
        $this->mockObject->getRequest()->setClientAdapter($adapter);

        $reflection = new \ReflectionMethod(get_class($this->mockObject), $method);
        $returnValue = $reflection->invokeArgs($this->mockObject, $params);
        
        $this->assertEquals($expectedObject, $returnValue);
    }
    
    /**
     * @dataProvider productionProvider
     */
    public function testAgainstRealInstance($method, $params, $serverKey)
    {
        $server = new Server($serverKey);
        if(!$server->canConnect())
            $this->markTestSkipped("Instance " . $serverKey . " not available - skipped");
                
        $reflect  = new \ReflectionClass("\\ZendService\\ZendServerAPI\\" . ucfirst($this->getSection()));
        $this->object = $reflect->newInstanceArgs(array($serverKey));
        
        $reflection = new \ReflectionMethod(get_class($this->object), $method);
        $returnValue = $reflection->invokeArgs($this->object, $params);
        
    }

    abstract function mockProvider();
    abstract function productionProvider();
    abstract function getSection();
    
    public function isLocalAvailable()
    {
        return $this->object->canConnect();
    }
    
    public function skipIfLocalIsNotAvailable()
    {
        if(!$this->isLocalAvailable())
            $this->markTestSkipped("Local is not available");
    }
}

