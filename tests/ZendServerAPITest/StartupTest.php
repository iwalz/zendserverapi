<?php
namespace ZendServerAPITest;

/**
 * test case.
 */
class StartupTest extends \PHPUnit_Framework_TestCase
{
    public function testStartup()
    {
        $request = \ZendService\ZendServerAPI\Startup::getRequest();
        $this->assertInstanceOf('ZendService\ZendServerAPI\Request', $request);
    }
    
    public function testNameInjections()
    {
        $di = \ZendService\ZendServerAPI\Startup::getRequest();
        $this->assertEquals( \ZendService\ZendServerAPI\Startup::getName(), "general");
        
        $di = \ZendService\ZendServerAPI\Startup::getRequest("example62");
        $this->assertEquals( \ZendService\ZendServerAPI\Startup::getName(), "example62");
        
        $di = \ZendService\ZendServerAPI\Startup::getRequest();
        $this->assertEquals( \ZendService\ZendServerAPI\Startup::getName(), "general");
    }

    public function testForInvalidConfigPart()
    {
        $this->setExpectedException(
                "InvalidArgumentException",
                "Configuration part 'duck' not found in: " . realpath('_files/config/config.php')
        );
        $di2 = \ZendService\ZendServerAPI\Startup::getRequest("duck");
    }
    
    public function testDefaultConfigForHttpsPort()
    {
        $request = \ZendService\ZendServerAPI\Startup::getRequest("httpsByPort");
        $this->assertEquals("https", $request->getConfig()->getProtocol());
    }
    
    public function testConfigForHttps()
    {
        $request = \ZendService\ZendServerAPI\Startup::getRequest("httpsBySetting");
        $this->assertEquals("https", $request->getConfig()->getProtocol());
    }
}

