<?php
namespace ZendServerAPITest;

/**
 * test case.
 */
class MonitorTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        if(DISABLE_REAL_INTERFACE === true)
            $this->markTestSkipped();
    }
    
    public function testMonitor()
    {
        \ZendServerAPI\Startup::enableLogging();
        $monitor = new \ZendServerAPI\Monitor("example62");
        $foo = $monitor->monitorGetIssuesListByPredefinedFilter("1");
        \ZendServerAPI\Startup::disableLogging();
    }
}

