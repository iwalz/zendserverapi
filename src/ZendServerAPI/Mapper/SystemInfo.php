<?php
namespace ZendServerAPI\Mapper;

use \ZendServerAPI\DataTypes\LicenseInfo,
    \ZendServerAPI\DataTypes\MessageList as MessageListData,
    \ZendServerAPI\DataTypes\SystemInfo as SystemInfoData;

class SystemInfo extends Mapper
{
    /**
     * @see \ZendServerAPI\Mapper\Mapper::parse()
     */
    public function parse($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();
        
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
         
        $messageListMapper = new \ZendServerAPI\Mapper\MessageList();
        $messageList = $messageListMapper->parse((string)$xml->responseData->messageList);
        $systemInfo->setMessageList($messageList);
         
        return $systemInfo;
    }
}

?>