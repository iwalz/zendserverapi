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
        $issueList = $monitor->monitorGetEventGroupDetails("226");
        var_dump($issueList);
        \ZendServerAPI\Startup::disableLogging();
    }
}

