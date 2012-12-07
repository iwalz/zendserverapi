<?php
namespace ZendServerAPITest\DataTypes;

use ZendService\ZendServerAPI\DataTypes\Issue;

use ZendService\ZendServerAPI\DataTypes\ApplicationServer;

/**
 * test case.
 */
class IssueTest extends \PHPUnit_Framework_TestCase
{

    public function testGettersAndSetters()
    {
        $issue = new Issue();
        $issue->setLastOccurance("03-Nov-2012");
        $this->assertInternalType('string', $issue->getLastOccurance());
    }
    
}

