<?php
namespace ZendServerAPITest\DataTypes;

use ZendService\ZendServerAPI\Deployment;

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

    public function testGetApplicationByName()
    {
        $strApplicationList = file_get_contents(__DIR__ . '/TestAsset/applicationList_multiple');
        $deployment = new Deployment('example62');
        $adapter = new \Zend\Http\Client\Adapter\Test();
        $adapter->setResponse($strApplicationList);
        $deployment->getRequest()->setClientAdapter($adapter);

        $applicationList = $deployment->applicationGetStatus();
        $result = $applicationList->getApplicationInfoByName('example2');
        $this->assertInstanceOf('\ZendService\ZendServerAPI\DataTypes\ApplicationInfo', $result);

        $this->assertEquals('example2', $result->getAppName());
        $this->assertEquals('120', $result->getId());

        $result = $applicationList->getApplicationInfoByName('foo');
        $this->assertFalse($result);


        $result = $applicationList->getApplicationInfoByName(null);
        $this->assertFalse($result);

    }
}

