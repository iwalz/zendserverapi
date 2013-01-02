<?php
namespace ZendServerAPITest\DataTypes;

use \ZendService\ZendServerAPI\DataTypes\ApplicationServer;

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
        $applicationInfo = new \ZendService\ZendServerAPI\DataTypes\ApplicationInfo();
        $applicationInfo->setAppName("example");
        $applicationInfo->setBaseUrl("http://www.example.com");
        $deployedVersions = array();
        $deployedVersion = new \ZendService\ZendServerAPI\DataTypes\DeployedVersions();
        $deployedVersion->setVersion("1.2");
        $deployedVersions[] = $deployedVersion;
        $applicationInfo->setDeployedVersions($deployedVersions);
        
        $this->assertEquals($deployedVersions, $applicationInfo->getDeployedVersions());
        $this->assertEquals("example", $applicationInfo->getAppName());
        $this->assertEquals("http://www.example.com", $applicationInfo->getBaseUrl());
    }
    
    public function testDataTypeToArray() 
    {
        $applicationInfo = new \ZendService\ZendServerAPI\DataTypes\ApplicationInfo();
        $applicationInfo->setId(62);
        $applicationInfo->setAppName("example");
        $applicationInfo->setBaseUrl("http://www.example.com");
        $deployedVersions = array();
        $deployedVersion = new \ZendService\ZendServerAPI\DataTypes\DeployedVersions();
        $deployedVersion->setVersion("1.2");
        $deployedVersions[] = $deployedVersion;
        $applicationInfo->setDeployedVersions($deployedVersions);
        
        $server1 = new ApplicationServer();
        $server1->setDeployedVersion($deployedVersion);
        $server1->setStatus("OK");
        $server1->setId(1);
        
        $server2 = new ApplicationServer();
        $server2->setDeployedVersion($deployedVersion);
        $server2->setStatus("OK");
        $server2->setId(2);
        
        $applicationInfo->addServer($server1);
        $applicationInfo->addServer($server2);
        
        $applicationInfoArray = array();
        $applicationInfoArray['id'] = 62;
        $applicationInfoArray['status'] = NULL;
        $applicationInfoArray['userAppName'] = NULL;
        $applicationInfoArray['installedlocation'] = NULL;
        $applicationInfoArray['status'] = NULL;
        $applicationInfoArray['appName'] = 'example';
        $applicationInfoArray['baseUrl'] = "http://www.example.com";
        $applicationInfoArray['messageList'] = NULL;
        $applicationInfoArray['deployedVersions'][0]['version'] = '1.2';
        $applicationInfoArray['applicationServer'][0]['deployedVersion']['version'] = '1.2';
        $applicationInfoArray['applicationServer'][1]['deployedVersion']['version'] = '1.2';
        $applicationInfoArray['applicationServer'][0]['status'] = 'OK';
        $applicationInfoArray['applicationServer'][1]['status'] = 'OK';
        $applicationInfoArray['applicationServer'][0]['id'] = 1;
        $applicationInfoArray['applicationServer'][1]['id'] = 2;

        $this->assertEquals($applicationInfoArray, $applicationInfo->extract());
    }

}

