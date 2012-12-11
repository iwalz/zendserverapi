<?php

namespace ZendServerAPITest\Integration;

use ZendService\ZendServerAPI\DataTypes\DeployedVersions;

use ZendService\ZendServerAPI\DataTypes\ApplicationServer;

use ZendService\ZendServerAPI\DataTypes\ApplicationInfo;

use ZendService\ZendServerAPI\DataTypes\ApplicationList;

use ZendService\ZendServerAPI\DataTypes\ServerInfo;
use ZendService\ZendServerAPI\DataTypes\MessageList;
use ZendService\ZendServerAPI\DataTypes\LicenseInfo;
use ZendService\ZendServerAPI\DataTypes\SystemInfo;
use ZendService\ZendServerAPI\DataTypes\ServersList;

class DeploymentIntegrationTest extends \ZendServerAPITest\Integration\BaseAPIIntegration
{
    public function setUp() 
    {
        $this->mockObject = new \ZendService\ZendServerAPI\Deployment();
        $this->object = new \ZendService\ZendServerAPI\Deployment(self::LOCAL);
        parent::setUp();
    }

    public function getApplicationGetStatus()
    {
        $applicationList = new ApplicationList();
        
        $applicationInfo = new ApplicationInfo();
        $applicationInfo->setId(119);
        $applicationInfo->setBaseUrl('http://test.com');
        $applicationInfo->setInstalledlocation('/usr/local/zend/var/apps/http/test.com/80/0.1');
        $applicationInfo->setAppName('example1');
        $applicationInfo->setUserAppName('Simple test app');
        $applicationInfo->setStatus('deployed');
        
        $deployedVersions = new DeployedVersions();
        $deployedVersions->setVersion('0.1');
        $applicationInfo->addDeployedVersions($deployedVersions);
        
        $server = new ApplicationServer();
        $server->setId(0);
        $server->setDeployedVersion('0.1');
        $server->setStatus('deployed');
        
        $applicationInfo->addServer($server);
        
        $applicationList->addApplicationInfo($applicationInfo);

        return $applicationList;
    }
    
    public function getApplicationDeploy()
    {
        $applicationInfo = new ApplicationInfo();
        $applicationInfo->setId(122);
        $applicationInfo->setBaseUrl('http://test.com');
        $applicationInfo->setInstalledlocation('');
        $applicationInfo->setAppName('example1');
        $applicationInfo->setUserAppName('Simple test app');
        $applicationInfo->setStatus('staging');
        
        $deployedVersions = new DeployedVersions();
        $deployedVersions->setVersion('0.1');
        $applicationInfo->addDeployedVersions($deployedVersions);
        
        $server = new ApplicationServer();
        $server->setId(0);
        $server->setDeployedVersion('0.1');
        $server->setStatus('staging');
        
        $applicationInfo->addServer($server);
        
        return $applicationInfo;
    }
    
    public function getApplicationUpdate()
    {
        $applicationInfo = new ApplicationInfo();
        $applicationInfo->setId(122);
        $applicationInfo->setBaseUrl('http://test.com');
        $applicationInfo->setAppName('example1');
        $applicationInfo->setUserAppName('Simple test app');
        $applicationInfo->setStatus('staging');
        $applicationInfo->setInstalledlocation('/usr/local/zend/var/apps/http/test.com/80/0.1');
    
        $deployedVersions = new DeployedVersions();
        $deployedVersions->setVersion('0.2');
        $applicationInfo->addDeployedVersions($deployedVersions);
    
        $server = new ApplicationServer();
        $server->setId(0);
        $server->setDeployedVersion('0.2');
        $server->setStatus('staging');
    
        $applicationInfo->addServer($server);
    
        return $applicationInfo;
    }
    
    public function getApplicationRollback()
    {
        $applicationInfo = new ApplicationInfo();
        $applicationInfo->setId(122);
        $applicationInfo->setBaseUrl('http://test.com');
        $applicationInfo->setAppName('example1');
        $applicationInfo->setUserAppName('Simple test app');
        $applicationInfo->setStatus('rollingBack');
        $applicationInfo->setInstalledlocation('/usr/local/zend/var/apps/http/test.com/80/0.2');
    
        $deployedVersions = new DeployedVersions();
        $deployedVersions->setVersion('0.2');
        $applicationInfo->addDeployedVersions($deployedVersions);
    
        $server = new ApplicationServer();
        $server->setId(0);
        $server->setDeployedVersion('0.2');
        $server->setStatus('rollingBack');
    
        $applicationInfo->addServer($server);
    
        return $applicationInfo;
    }
    
    public function getApplicationRemove()
    {
        $applicationInfo = new ApplicationInfo();
        $applicationInfo->setId(122);
        $applicationInfo->setBaseUrl('http://test.com');
        $applicationInfo->setAppName('example1');
        $applicationInfo->setUserAppName('Simple test app');
        $applicationInfo->setStatus('deactivating');
        $applicationInfo->setInstalledlocation('/usr/local/zend/var/apps/http/test.com/80/0.1');
    
        $deployedVersions = new DeployedVersions();
        $deployedVersions->setVersion('0.1');
        $applicationInfo->addDeployedVersions($deployedVersions);
    
        $server = new ApplicationServer();
        $server->setId(0);
        $server->setDeployedVersion('0.1');
        $server->setStatus('deactivating');
    
        $applicationInfo->addServer($server);
    
        return $applicationInfo;
    }
    
    public function getApplicationSynchronize()
    {
        $applicationInfo = new ApplicationInfo();
        $applicationInfo->setId(123);
        $applicationInfo->setBaseUrl('http://test.com');
        $applicationInfo->setAppName('example1');
        $applicationInfo->setUserAppName('Simple test app');
        $applicationInfo->setStatus('staging');
        $applicationInfo->setInstalledlocation('/usr/local/zend/var/apps/http/test.com/80/0.1');
    
        $deployedVersions = new DeployedVersions();
        $deployedVersions->setVersion('0.1');
        $applicationInfo->addDeployedVersions($deployedVersions);
    
        $server = new ApplicationServer();
        $server->setId(0);
        $server->setDeployedVersion('0.1');
        $server->setStatus('staging');
    
        $applicationInfo->addServer($server);
    
        return $applicationInfo;
    }
    
    public function mockProvider()
    {
        static::$mockDataProvider = array(
            array("applicationGetStatus", $this->getApplicationGetStatus(), array()),
            array("applicationDeploy", $this->getApplicationDeploy(), array(
                __DIR__.'/TestAssets/example1.zpk',
                "http://test.com",
                true,
                false,
                'Simple test app',
                false
            )),
            array("applicationUpdate", $this->getApplicationUpdate(), array(122, __DIR__.'/TestAssets/example1-2.zpk')),
            array("applicationRollback", $this->getApplicationRollback(), array(122)),
            array("applicationRemove", $this->getApplicationRemove(), array(122)),
            array("applicationSynchronize", $this->getApplicationSynchronize(), array(123))
        );
                 
        return static::$mockDataProvider;
    }   
    
    public function productionProvider()
    {
        static::$localDataProvider = array(
                array("applicationGetStatus", array(), self::LOCAL)
                #array("restartPhp", array(), self::LOCAL)
        );
         
        return static::$localDataProvider;
    }

    public function getSection()
    {
        return "deployment";
    }
}

