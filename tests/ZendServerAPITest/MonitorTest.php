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
        $studio = new \ZendService\ZendServerAPI\Studio("example62");
        $monitor = new \ZendService\ZendServerAPI\Monitor("example62");
        $issueList = $monitor->monitorGetIssuesListByPredefinedFilter('All Events');
        foreach($issueList as $issue) 
        {
            /* @var $issue \ZendService\ZendServerAPI\DataTypes\Issue */
            $details = $monitor->monitorGetEventGroupDetails($issue->getId());
            $eventsGroupId = $details->getEventsGroup()->getEventsGroupId();
            if($eventsGroupId)
                break;
        }
        $debugRequest = $studio->studioStartProfile($eventsGroupId);
    }
}

