<?php
namespace ZendServerAPITest;

/**
 * test case.
 */
class StartupTest extends \PHPUnit_Framework_TestCase
{
    public function testStartup()
    {
        $di = \ZendServerAPI\Startup::getDIC();
        $this->assertInstanceOf('\Zend\Di\Di', $di);
        $this->assertInstanceOf('ZendServerAPI\Request', $di->get('ZendServerAPI\Request'));
    }
    
    public function testNameInjections()
    {
        $di = \ZendServerAPI\Startup::getDIC();
        $this->assertEquals(\ZendServerAPI\Startup::getName(), "general");
        
        $di = \ZendServerAPI\Startup::getDIC("example62");
        $this->assertEquals(\ZendServerAPI\Startup::getName(), "example62");
        
        $di = \ZendServerAPI\Startup::getDIC();
        $this->assertEquals(\ZendServerAPI\Startup::getName(), "general");
    }

    public function testForInvalidConfigPart()
    {
        $this->setExpectedException(
                "InvalidArgumentException",
                "Configuration part 'duck' not found in: " . realpath('_files/config/servers.ini')
        );
        $di2 = \ZendServerAPI\Startup::getDIC("duck");
    }
}

