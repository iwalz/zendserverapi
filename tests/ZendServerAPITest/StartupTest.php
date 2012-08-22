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
}

