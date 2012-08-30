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
        
        $di = \ZendServerAPI\Startup::getDIC("example72");
        $this->assertEquals(\ZendServerAPI\Startup::getName(), "example72");
        
        $di = \ZendServerAPI\Startup::getDIC();
        $this->assertEquals(\ZendServerAPI\Startup::getName(), "general");
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Configuration part 'duck' not found in: /var/www/zendserverapi/tests/_files/config/servers.ini
     */
    public function testForInvalidConfigPart()
    {
        $di2 = \ZendServerAPI\Startup::getDIC("duck");
    }
}

