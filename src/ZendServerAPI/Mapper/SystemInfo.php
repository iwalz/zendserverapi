<?php
namespace ZendServerAPI\Mapper;

use \ZendServerAPI\DataTypes\LicenseInfo,
    \ZendServerAPI\DataTypes\MessageList,
    \ZendServerAPI\DataTypes\SystemInfo as SystemInfoData;

class SystemInfo extends Mapper
{
    /**
     * @see \ZendServerAPI\Mapper\Mapper::parse()
     */
    public function parse($xml)
    {
        $xml = simplexml_load_string($xml);
        $systemInfo = new SystemInfoData();
        $systemInfo->setStatus((string)$xml->responseData->systemInfo->status);
        $systemInfo->setEdition((string)$xml->responseData->systemInfo->edition);
        $systemInfo->setZendServerVersion((string)$xml->responseData->systemInfo->zendServerVersion);
        $systemInfo->setSupportedApiVersions((string)trim($xml->responseData->systemInfo->supportedApiVersions));
        $systemInfo->setPhpVersion((string)$xml->responseData->systemInfo->phpVersion);
        $systemInfo->setOperatingSystem((string)$xml->responseData->systemInfo->operatingSystem);
        $systemInfo->setDeploymentVersion((string)$xml->responseData->systemInfo->deploymentVersion);
        
        $serverLicenseInfo = new LicenseInfo();
        $serverLicenseInfo->setStatus((string)$xml->responseData->systemInfo->serverLicenseInfo->status);
        $serverLicenseInfo->setOrderNumber((string)$xml->responseData->systemInfo->serverLicenseInfo->orderNumber);
        $serverLicenseInfo->setValidUntil((string)$xml->responseData->systemInfo->serverLicenseInfo->validUntil);
        $serverLicenseInfo->setServerLimit((string)$xml->responseData->systemInfo->serverLicenseInfo->serverLimit);
        $systemInfo->setServerLincenseInfo($serverLicenseInfo);
         
        $managerLicenseInfo = new LicenseInfo();
        $managerLicenseInfo->setStatus((string)$xml->responseData->systemInfo->managerLicenseInfo->status);
        $managerLicenseInfo->setOrderNumber((string)$xml->responseData->systemInfo->managerLicenseInfo->orderNumber);
        $managerLicenseInfo->setValidUntil((string)$xml->responseData->systemInfo->managerLicenseInfo->validUntil);
        $managerLicenseInfo->setServerLimit((string)$xml->responseData->systemInfo->managerLicenseInfo->serverLimit);
        $systemInfo->setManagerLicenseInfo($managerLicenseInfo);
         
        $messageList = new MessageList();
        $messageList->setError((string)$xml->responseData->messageList->error);
        $messageList->setInfo((string)$xml->responseData->messageList->info);
        $messageList->setWarning((string)$xml->responseData->messageList->warning);
        $systemInfo->setMessageList($messageList);
         
        return $systemInfo;
    }
}

?>