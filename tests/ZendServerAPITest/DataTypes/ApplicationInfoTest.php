<?php
namespace ZendServerAPITest\DataTypes;

/**
 * test case.
 */
class ApplicationInfoTest extends \PHPUnit_Framework_TestCase
{

    protected function setUp ()
    {

    }
    
    public function testGettersAndSetters()
    {
        $applicationInfo = new \ZendServerAPI\DataTypes\ApplicationInfo();
        $applicationInfo->setAppName("example");
        $applicationInfo->setBaseUrl("http://www.example.com");
        $deployedVersions = array();
        $deployedVersion = new \ZendServerAPI\DataTypes\DeployedVersions();
        $deployedVersion->setVersion("1.2");
        $deployedVersions[] = $deployedVersion;
        $applicationInfo->setDeployedVersions($deployedVersions);
        
        $this->assertEquals($deployedVersions, $applicationInfo->getDeployedVersions());
        $this->assertEquals("example", $applicationInfo->getAppName());
        $this->assertEquals("http://www.example.com", $applicationInfo->getBaseUrl());
    }

}

