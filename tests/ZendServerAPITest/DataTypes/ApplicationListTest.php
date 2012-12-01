<?php
namespace ZendServerAPITest\DataTypes;

/**
 * test case.
 */
class ApplicationListTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp ()
    {

    }

    public function testGettersAndSetters()
    {
        $applicationList = new \ZendService\ZendServerAPI\DataTypes\ApplicationList();
        $applicationInfo = new \ZendService\ZendServerAPI\DataTypes\ApplicationInfo();
        $applicationInfo->setAppName("example");
        $applicationList->addApplicationInfo($applicationInfo);
        
        $this->assertEquals(array($applicationInfo), $applicationList->getApplicationInfos());
    }
}

