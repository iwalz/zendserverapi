<?php
namespace ZendServerAPI\Mapper;

class ApplicationInfo extends Mapper
{
    /**
     * @see \ZendServerAPI\Mapper\Mapper::parse()
     */
    public function parse ($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();
    
        $xml = simplexml_load_string($xml);

        $applicationInfo = new \ZendServerAPI\DataTypes\ApplicationInfo();
        $applicationInfo->setAppName((string)$xml->responseData->appName);
        $applicationInfo->setId((string)$xml->responseData->id);
        $applicationInfo->setBaseUrl((string)$xml->responseData->baseUrl);
        $applicationInfo->setUserAppName((string)$xml->responseData->userAppName);
        $applicationInfo->setInstalledlocation((string)trim($xml->responseData->installedLocation));
        $applicationInfo->setStatus((string)$xml->responseData->status);
        
        if(isset($xml->responseData->servers->applicationServer))
        {
            foreach($xml->responseData->servers->applicationServer as $xmlServer)
            {
                $server = new \ZendServerAPI\DataTypes\ApplicationServer();
                $server->setId((string)$xmlServer->id);
                $server->setDeployedVersion((string)trim($xmlServer->deployedVersion));
                $server->setStatus((string)$xmlServer->status);
                $applicationInfo->addServer($server);
            }
        }
        if(isset($xml->responseData->deployedVersions->deployedVersion))
        {
            foreach($xml->responseData->deployedVersions->deployedVersion as $xmlDeployedVersions)
            {
                $deployedVersions = new \ZendServerAPI\DataTypes\DeployedVersions();
                $deployedVersions->setVersion((string)trim($xmlDeployedVersions));
                $applicationInfo->addDeployedVersions($deployedVersions);
            }
        }
        
        $messageListMapper = new \ZendServerAPI\Mapper\MessageList();
        $xmlMessageList = (string)$xml->responseData->messageList;
        
        if(!empty($xmlMessageList))
            $applicationInfo->setMessageList($messageListMapper->parse($xmlMessageList));
        
        return $applicationInfo;
    }
}

?>