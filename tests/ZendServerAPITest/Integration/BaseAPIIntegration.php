<?php

namespace ZendServerAPITest\Integration;

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
    protected $localObject = null;
    
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
        $returnValue = $reflection->invoke($this->mockObject, $params);
        
        $this->assertEquals($expectedObject, $returnValue);
    }
    
    /**
     * @dataProvider localProvider
     */
    public function testAgainstLocalInstance($method, $params)
    {
        $this->skipIfLocalIsNotAvailable();
                
        $result = call_user_method_array($method, $this->localObject, $params);
//         var_dump($this->localObject->getRequest()->getClient()->getResponse());
    }

    abstract function mockProvider();
    abstract function localProvider();
    abstract function getSection();
    
    public function isLocalAvailable()
    {
        return $this->localObject->canConnect();
    }
    
    public function skipIfLocalIsNotAvailable()
    {
        if(!$this->isLocalAvailable())
            $this->markTestSkipped("Local is not available");
    }
}

