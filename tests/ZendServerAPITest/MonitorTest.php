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
        $studio = new \ZendServerAPI\Studio("example62");
        $monitor = new \ZendServerAPI\Monitor("example62");
        $details = $monitor->monitorGetEventGroupDetails("247");
        $debugRequest = $studio->studioStartProfile($details->getEventsGroup()->getEventsGroupId());
        \ZendServerAPI\Startup::disableLogging();
    }
}

