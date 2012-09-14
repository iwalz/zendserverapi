<?php
namespace ZendServerAPITest;

/**
 * test case.
 */
class ApplicationInfoMapperTest extends \PHPUnit_Framework_TestCase
{
    public function testMapper()
    {
        $applicationGetStatus = new \ZendServerAPI\Mapper\ApplicationList();
        $result = $applicationGetStatus->parse(file_get_contents(__DIR__.'/../DataTypes/TestAsset/applicationlist.xml'));
        
        $applicationList = new \ZendServerAPI\DataTypes\ApplicationList();
        $applicationInfo1 = new \ZendServerAPI\DataTypes\ApplicationInfo();
        $applicationInfo1->setAppName('Wordpress');
        $applicationInfo1->setId('1');
        $applicationInfo1->setBaseUrl('http://example.com/myapp');
        $applicationInfo1->setUserAppName("Wolfgang's Blog");
        $applicationInfo1->setInstalledlocation('/usr/local/somewhere');
        $applicationInfo1->setStatus('partially deployed');
        $deployedVersions1 = new \ZendServerAPI\DataTypes\DeployedVersions();
        $deployedVersions1->setVersion('1.6');
        $deployedVersions2 = new \ZendServerAPI\DataTypes\DeployedVersions();
        $deployedVersions2->setVersion('1.5');
        $applicationInfo1->addDeployedVersions($deployedVersions1);
        $applicationInfo1->addDeployedVersions($deployedVersions2);
        $server1 = new \ZendServerAPI\DataTypes\ApplicationServer();
        $server1->setStatus('OK');
        $server1->setDeployedVersion('1.6');
        $server1->setId('1');
        $server2 = new \ZendServerAPI\DataTypes\ApplicationServer();
        $server2->setId('4');
        $server2->setDeployedVersion('1.6');
        $server2->setStatus('OK');
        $server3 = new \ZendServerAPI\DataTypes\ApplicationServer();
        $server3->setId('8');
        $server3->setDeployedVersion('1.5');
        $server3->setStatus('OK');
        $applicationInfo1->addServer($server1);
        $applicationInfo1->addServer($server2);
        $applicationInfo1->addServer($server3);
        $applicationList->addApplicationInfo($applicationInfo1);
        
        $applicationInfo2 = new \ZendServerAPI\DataTypes\ApplicationInfo();
        $applicationInfo2->setAppName('Blog 2.0');
        $applicationInfo2->setId('2');
        $applicationInfo2->setBaseUrl('http://oapp.example.com:8080/');
        $applicationInfo2->setUserAppName("Wolfgang's Blog");
        $applicationInfo2->setInstalledlocation('/usr/local/somewhere');
        $applicationInfo2->setStatus('staging');
        $deployedVersions1 = new \ZendServerAPI\DataTypes\DeployedVersions();
        $deployedVersions1->setVersion('1.6');
        $deployedVersions2 = new \ZendServerAPI\DataTypes\DeployedVersions();
        $deployedVersions2->setVersion('1.5');
        $applicationInfo2->addDeployedVersions($deployedVersions1);
        $applicationInfo2->addDeployedVersions($deployedVersions2);
        $server1 = new \ZendServerAPI\DataTypes\ApplicationServer();
        $server1->setId('1');
        $server1->setDeployedVersion('1.6');
        $server1->setStatus('staging');
        $server2 = new \ZendServerAPI\DataTypes\ApplicationServer();
        $server2->setId('4');
        $server2->setDeployedVersion('1.6');
        $server2->setStatus('staging');
        $server3 = new \ZendServerAPI\DataTypes\ApplicationServer();
        $server3->setId('8');
        $server3->setDeployedVersion('1.5');
        $server3->setStatus('staging');
        $applicationInfo2->addServer($server1);
        $applicationInfo2->addServer($server2);
        $applicationInfo2->addServer($server3);
        $applicationList->addApplicationInfo($applicationInfo2);
        
        foreach($result->getApplicationInfos() as $applicationInfo)
        {
            $this->assertNull($applicationInfo->getMessageList());
            foreach($applicationInfo->getServers() as $server)
            {
                $this->assertInstanceOf('\ZendServerAPI\DataTypes\ApplicationServer', $server);
            }
            foreach($applicationInfo->getDeployedVersions() as $deployedVersion)
            {
                $this->assertInstanceOf('\ZendServerAPI\DataTypes\DeployedVersions', $deployedVersion);
            }
        }
        $this->assertEquals($applicationList, $result);
    }
    
    public function testDataTypes()
    {
        $applicationGetStatus = new \ZendServerAPI\Mapper\ApplicationList();
        $result = $applicationGetStatus->parse(file_get_contents(__DIR__.'/../DataTypes/TestAsset/applicationlist.xml'));
        
        foreach($result->getApplicationInfos() as $applicationInfo)
        {
            $this->assertNull($applicationInfo->getMessageList());
            foreach($applicationInfo->getServers() as $server)
            {
                $this->assertInstanceOf('\ZendServerAPI\DataTypes\ApplicationServer', $server);
            }
            foreach($applicationInfo->getDeployedVersions() as $deployedVersion)
            {
                $this->assertInstanceOf('\ZendServerAPI\DataTypes\DeployedVersions', $deployedVersion);
            }
        }
    }
}

