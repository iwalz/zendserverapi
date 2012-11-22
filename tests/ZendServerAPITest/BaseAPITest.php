<?php

use ZendServerAPI\Request;

use ZendServerAPI\BaseAPI;

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * test case.
 */
class BaseAPITest extends PHPUnit_Framework_TestCase
{
    public function testGettersAndSetters()
    {
        $baseAPI = new BaseAPI();
        $request = new Request();
        
        $baseAPI->setRequest($request);
        
        $this->assertSame($request, $baseAPI->getRequest());
    }
    
    public function testFirstEventGroupsIdByIssueId()
    {
        $monitor = new \ZendServerAPI\Monitor("example62");
        if(!$monitor->canConnect())
            $this->markTestSkipped("Can't connect to server");
    
        $list = $monitor->monitorGetIssuesListByPredefinedFilter('All Events');
        $issue = $list->getIterator()->current();
    
        $detail = $monitor->monitorGetEventGroupDetails($issue->getId());
        $this->assertTrue($detail instanceof \ZendServerAPI\DataTypes\EventsGroupDetails);
    }
}

