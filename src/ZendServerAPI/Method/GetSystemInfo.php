<?php

namespace ZendServerAPI\Method;

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
	    $systemInfo->setServerLincenseInfo(new \ZendServerAPI\DataTypes\LicenseInfo($xml->responseData->systemInfo->serverLicenseInfo->asXml()));
	    $systemInfo->setManagerLicenseInfo(new \ZendServerAPI\DataTypes\LicenseInfo($xml->responseData->systemInfo->managerLicenseInfo->asXml()));
	    $systemInfo->setMessageList(new \ZendServerAPI\DataTypes\MessageList($xml->responseData->systemInfo->messageList->asXml()));
	    
	    return $systemInfo;
	}
}

?>