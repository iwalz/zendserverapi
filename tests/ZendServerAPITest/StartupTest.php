<?php
namespace ZendServerAPITest;

/**
 * test case.
 */
class StartupTest extends \PHPUnit_Framework_TestCase
{
    public function testStartup()
    {
        $request = \ZendServerAPI\Startup::getRequest();
        $this->assertInstanceOf('ZendServerAPI\Request', $request);
    }
    
    public function testNameInjections()
    {
        $di = \ZendServerAPI\Startup::getRequest();
        $this->assertEquals(\ZendServerAPI\Startup::getName(), "general");
        
        $di = \ZendServerAPI\Startup::getRequest("example62");
        $this->assertEquals(\ZendServerAPI\Startup::getName(), "example62");
        
        $di = \ZendServerAPI\Startup::getRequest();
        $this->assertEquals(\ZendServerAPI\Startup::getName(), "general");
    }

    public function testForInvalidConfigPart()
    {
        $this->setExpectedException(
                "InvalidArgumentException",
                "Configuration part 'duck' not found in: " . realpath('_files/config/servers.ini')
        );
        $di2 = \ZendServerAPI\Startup::getRequest("duck");
    }
}

