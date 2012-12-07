<?php

namespace ZendServerAPITest\Integration;

class ServerIntegrationTest extends \ZendServerAPITest\Integration\BaseAPIIntegration
{
    public function setUp() 
    {
        $this->state = 'cluster';
        parent::setUp();
    }
    
    public function getSystemInfo()
    {
        $systemInfo = new \ZendService\ZendServerAPI\DataTypes\SystemInfo();
        
        $systemInfo->setStatus("OK");
        $systemInfo->setEdition("ZendServer");
        $systemInfo->setZendServerVersion("5.6.0");
        $systemInfo->setSupportedApiVersions("application/vnd.zend.serverapi+xml;version=1.0,
                                application/vnd.zend.serverapi+xml;version=1.1,
                                application/vnd.zend.serverapi+xml;version=1.2");
        $systemInfo->setPhpVersion("5.3.14");
        $systemInfo->setOperatingSystem("Linux");
        $systemInfo->setDeploymentVersion("1.0");

        $serverLicenseInfo = new \ZendService\ZendServerAPI\DataTypes\LicenseInfo();
        $serverLicenseInfo->setStatus("OK");
        $serverLicenseInfo->setOrderNumber("GR-00280-12");
        $serverLicenseInfo->setValidUntil(0);
        $serverLicenseInfo->setServerLimit(0);
        $systemInfo->setServerLicenseInfo($serverLicenseInfo);
        
        $managerLicenseInfo = new \ZendService\ZendServerAPI\DataTypes\LicenseInfo();
        $managerLicenseInfo->setStatus("notRequired");
        $managerLicenseInfo->setOrderNumber("");
        $managerLicenseInfo->setValidUntil(0);
        $managerLicenseInfo->setServerLimit(0);
        $systemInfo->setManagerLicenseInfo($managerLicenseInfo);
        
        $systemInfo->setMessageList(new \ZendService\ZendServerAPI\DataTypes\MessageList());
        
        return $systemInfo;
    }
    
    public function mockProvider()
    {
        static::$mockDataProvider = array(
            array("getSystemInfo", $this->getSystemInfo(), array())
        );
                 
        return static::$mockDataProvider;
    }   

}

