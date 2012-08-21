<?php

namespace ZendServerAPI\Method;

use ZendServerAPI\DataTypes\LicenseInfo;

class GetSystemInfo extends \ZendServerAPI\Method 
{
	public function configure()
	{
		$this->setMethod('GET');
		$this->setFunctionPath('/ZendServerManager/Api/getSystemInfo');
	}
	
	public function parseResponse($xml)
	{
	    $xml = simplexml_load_string($xml);
	    
	    $systemInfo = new \ZendServerAPI\DataTypes\SystemInfo();
	    $systemInfo->setStatus((string)$xml->responseData->systemInfo->status);
	    $systemInfo->setEdition((string)$xml->responseData->systemInfo->edition);
	    $systemInfo->setZendServerVersion((string)$xml->responseData->systemInfo->zendServerVersion);
	    $systemInfo->setSupportedApiVersions((string)trim($xml->responseData->systemInfo->supportedApiVersions));
	    $systemInfo->setPhpVersion((string)$xml->responseData->systemInfo->phpVersion);
	    $systemInfo->setOperatingSystem((string)$xml->responseData->systemInfo->operatingSystem);

	    $serverLicenseInfo = new LicenseInfo();
	    $serverLicenseInfo->setStatus((string)$xml->responseData->systemInfo->serverLicenseInfo->status);
	    $serverLicenseInfo->setOrderNumber((string)$xml->responseData->systemInfo->serverLicenseInfo->orderNumber);
	    $serverLicenseInfo->setValidUntil((string)$xml->responseData->systemInfo->serverLicenseInfo->validUntil);
	    $serverLicenseInfo->setServerLimit((string)$xml->responseData->systemInfo->serverLicenseInfo->nodeLimit);
	    $systemInfo->setServerLincenseInfo($serverLicenseInfo);
	    
	    $managerLicenseInfo = new LicenseInfo();
	    $managerLicenseInfo->setStatus((string)$xml->responseData->systemInfo->managerLicenseInfo->status);
	    $managerLicenseInfo->setOrderNumber((string)$xml->responseData->systemInfo->managerLicenseInfo->orderNumber);
	    $managerLicenseInfo->setValidUntil((string)$xml->responseData->systemInfo->managerLicenseInfo->validUntil);
	    $managerLicenseInfo->setServerLimit((string)$xml->responseData->systemInfo->managerLicenseInfo->nodeLimit);
	    $systemInfo->setManagerLicenseInfo($managerLicenseInfo);
	    
	    $systemInfo->setMessageList(new \ZendServerAPI\DataTypes\MessageList($xml->responseData->systemInfo->messageList->asXml()));
	    
	    return $systemInfo;
	}
}

?>