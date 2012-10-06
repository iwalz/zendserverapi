<?php
namespace ZendServerAPITest;

/**
 * test case.
 */
class MonitorTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
//         if(DISABLE_REAL_INTERFACE === true)
//             $this->markTestSkipped();
    }
    
    public function testMonitor()
    {
        \ZendServerAPI\Startup::enableLogging();
        $monitor = new \ZendServerAPI\Monitor("example62");
        $issueList = $monitor->monitorGetIssueDetails("72");
        \ZendServerAPI\Startup::disableLogging();
    }
}

