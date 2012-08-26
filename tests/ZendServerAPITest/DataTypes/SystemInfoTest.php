<?php
namespace ZendServerAPITest;
use ZendServerAPI\DataTypes\SystemInfo;

use ZendServerAPI\DataTypes\MessageList;

use ZendServerAPI\DataTypes\LicenseInfo;
/**
 * test case.
 */
class SystemInfoTest extends \PHPUnit_Framework_TestCase
{

    public static $systemInfoObject = null;
    public static $systemInfo = <<<EOF
    <zendServerAPIResponse xmlns="http://www.zend.com/server/api/1.0">
        <requestData>
            <apiKeyName>angel.eyes</apiKeyName>
            <method>getSystemInfo</method>
        </requestData>
        <responseData>
            <systemInfo>
                <status>OK</status>
                <edition>
                    ZendServerClusterManager
                </edition>
                <zendServerVersion>6.0.1</zendServerVersion>
                <supportedApiVersions>
                    application/vnd.zend.serverapi+xml;version=1.0,
                    application/vnd.zend.serverapi+xml;version=1.1,
                    application/vnd.zend.serverapi+xml;version=2.0
                </supportedApiVersions>
                <phpVersion>5.4.1</phpVersion>
                <operatingSystem>Linux</operatingSystem>
                <deploymentVersion>1.0</deploymentVersion>
                <serverLicenseInfo>
                    <status>OK</status>
                    <orderNumber>ZEND-ORDER-66</orderNumber>
                    <validUntil>Sat, 31 Mar 2012 00:00:00 GMT</validUntil>
                    <serverLimit>0</serverLimit>
                </serverLicenseInfo>
                <managerLicenseInfo>
                    <status>serverLimitExceeded</status>
                    <orderNumber>ZEND-ORDER-66</orderNumber>
                    <validUntil>Sat, 31 Mar 2012 00:00:00 GMT</validUntil>
                    <serverLimit>10</serverLimit>
                </managerLicenseInfo>
            </systemInfo>
        </responseData>
    </zendServerAPIResponse>
EOF;
    public function testParseResultSystemInfo()
    {
        $action = new \ZendServerAPI\Method\GetSystemInfo();
        $systemInfo = $action->parseResponse(self::$systemInfo);
        
        $testSystemInfo = new SystemInfo();
        $testSystemInfo->setStatus("OK");
        $testSystemInfo->setEdition("ZendServerClusterManager");
        $testSystemInfo->setZendServerVersion("6.0.1");
        $testSystemInfo->setSupportedApiVersions(
                "application/vnd.zend.serverapi+xml;version=1.0,
                    application/vnd.zend.serverapi+xml;version=1.1,
                    application/vnd.zend.serverapi+xml;version=2.0");
        $testSystemInfo->setPhpVersion("5.4.1");
        $testSystemInfo->setOperatingSystem("Linux");
        $testSystemInfo->setDeploymentVersion("1.0");
        
        $testLicenseInfo = new LicenseInfo();
        $testLicenseInfo->setStatus("OK");
        $testLicenseInfo->setOrderNumber("ZEND-ORDER-66");
        $testLicenseInfo->setValidUntil("Sat, 31 Mar 2012 00:00:00 GMT");
        $testLicenseInfo->setServerLimit("0");
        
        $testManagerLicenseInfo = new LicenseInfo();
        $testManagerLicenseInfo->setStatus("serverLimitExceeded");
        $testManagerLicenseInfo->setOrderNumber("ZEND-ORDER-66");
        $testManagerLicenseInfo->setValidUntil("Sat, 31 Mar 2012 00:00:00 GMT");
        $testManagerLicenseInfo->setServerLimit("10");
        
        $testSystemInfo->setServerLincenseInfo($testLicenseInfo);
        $this->assertInstanceOf('\ZendServerAPI\DataTypes\LicenseInfo', $testSystemInfo->getServerLincenseInfo());
        $this->assertEquals($testLicenseInfo, $testSystemInfo->getServerLincenseInfo());
        
        $testSystemInfo->setManagerLicenseInfo($testManagerLicenseInfo);
        $this->assertInstanceOf('\ZendServerAPI\DataTypes\LicenseInfo', $testSystemInfo->getManagerLicenseInfo());
        $this->assertEquals($testManagerLicenseInfo, $testSystemInfo->getManagerLicenseInfo());
        
        $testSystemInfo->setMessageList(new MessageList());
        
        $this->assertEquals($testSystemInfo, $systemInfo);
        
        self::$systemInfoObject = $testSystemInfo;
    }
    
}

