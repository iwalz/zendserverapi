<?php
namespace ZendServerAPITest;
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
		<apiKeyName><![CDATA[api]]></apiKeyName>
		<method>getSystemInfo</method>
	</requestData>
	<responseData>
		<systemInfo>
			<status>OK</status>
			<edition>ZendServer</edition>
			<zendServerVersion>5.6.0</zendServerVersion>
			<supportedApiVersions>
				application/vnd.zend.serverapi+xml;version=1.0,
				application/vnd.zend.serverapi+xml;version=1.1,
				application/vnd.zend.serverapi+xml;version=1.2
			</supportedApiVersions>
			<phpVersion>5.3.14</phpVersion>
			<operatingSystem>Linux</operatingSystem>
			<deploymentVersion>1.0</deploymentVersion>
			<serverLicenseInfo>
				<status>OK</status>
				<orderNumber>AB-222-12</orderNumber>
				<validUntil>Wed, 7 Nov 2012 23:00:00 GMT</validUntil>
				<nodeLimit>255</nodeLimit>
			</serverLicenseInfo>
			<managerLicenseInfo>
				<status>notRequired</status>
				<orderNumber></orderNumber>
				<validUntil></validUntil>
				<nodeLimit></nodeLimit>
			</managerLicenseInfo>
			<messageList></messageList>
		</systemInfo>	</responseData>
</zendServerAPIResponse>
EOF;
    public function testParseResultSystemInfo()
    {
        $action = new \ZendServerAPI\Method\GetSystemInfo();
        $systemInfo = $action->parseResponse(self::$systemInfo);
    
        $this->assertEquals($systemInfo->getStatus(), "OK");
        $this->assertEquals($systemInfo->getEdition(), "ZendServer");
        $this->assertEquals($systemInfo->getZendServerVersion(), "5.6.0");
        $this->assertEquals($systemInfo->getSupportedApiVersions(),
                "application/vnd.zend.serverapi+xml;version=1.0,
				application/vnd.zend.serverapi+xml;version=1.1,
				application/vnd.zend.serverapi+xml;version=1.2");
        $this->assertEquals($systemInfo->getPHPVersion(), "5.3.14");
        $this->assertEquals($systemInfo->getOperatingSystem(), "Linux");
    
        $licenseInfo = new LicenseInfo();
        $licenseInfo->setStatus("OK");
        $licenseInfo->setOrderNumber("AB-222-12");
        $licenseInfo->setValidUntil("Wed, 7 Nov 2012 23:00:00 GMT");
        $licenseInfo->setServerLimit("255");
    
        $this->assertInstanceOf('\ZendServerAPI\DataTypes\LicenseInfo', $systemInfo->getServerLincenseInfo());
        $this->assertEquals($licenseInfo, $systemInfo->getServerLincenseInfo());
    
        $managerLicenseInfo = new LicenseInfo();
        $managerLicenseInfo->setStatus("notRequired");
        $managerLicenseInfo->setOrderNumber("");
        $managerLicenseInfo->setValidUntil("");
        $managerLicenseInfo->setServerLimit("");
    
        $this->assertInstanceOf('\ZendServerAPI\DataTypes\LicenseInfo', $systemInfo->getManagerLicenseInfo());
        $this->assertEquals($managerLicenseInfo, $systemInfo->getManagerLicenseInfo());
    
        $messageList = new MessageList();
        $this->assertInstanceOf('\ZendServerAPI\DataTypes\MessageList', $systemInfo->getMessageList());
        $this->assertEquals($messageList, $systemInfo->getMessageList());
        
        self::$systemInfoObject = $systemInfo;
    }
    
}

