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
    
    public function testDataTypeToArray() 
    {
        $applicationInfo = new \ZendServerAPI\DataTypes\ApplicationInfo();
        $applicationInfo->setId(62);
        $applicationInfo->setAppName("example");
        $applicationInfo->setBaseUrl("http://www.example.com");
        $deployedVersions = array();
        $deployedVersion = new \ZendServerAPI\DataTypes\DeployedVersions();
        $deployedVersion->setVersion("1.2");
        $deployedVersions[] = $deployedVersion;
        $applicationInfo->setDeployedVersions($deployedVersions);
        
        $applicationInfoArray = array();
        $applicationInfoArray['id'] = 62;
        $applicationInfoArray['status'] = NULL;
        $applicationInfoArray['userAppName'] = NULL;
        $applicationInfoArray['installedlocation'] = NULL;
        $applicationInfoArray['status'] = NULL;
        $applicationInfoArray['appName'] = 'example';
        $applicationInfoArray['baseUrl'] = "http://www.example.com";
        $applicationInfoArray['messageList'] = NULL;
        $applicationInfoArray['deployedVersions']['version'] = '1.2';
        $this->assertEquals($applicationInfoArray, $applicationInfo->getArray());
    }

}

