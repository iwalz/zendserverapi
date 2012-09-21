<?php
namespace ZendServerAPI\Mapper;

class ApplicationList extends Mapper
{
    /**
     * @see \ZendServerAPI\Mapper\Mapper::parse()
     */
    public function parse ($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);

        $applicationList = new \ZendServerAPI\DataTypes\ApplicationList();
        foreach ($xml->responseData->applicationsList->applicationInfo as $xmlAppInfo) {
            $applicationInfo = new \ZendServerAPI\DataTypes\ApplicationInfo();
            $applicationInfo->setAppName((string) $xmlAppInfo->appName);
            $applicationInfo->setId((string) $xmlAppInfo->id);
            $applicationInfo->setBaseUrl((string) $xmlAppInfo->baseUrl);
            $applicationInfo->setUserAppName((string) $xmlAppInfo->userAppName);
            $applicationInfo->setInstalledlocation((string) trim($xmlAppInfo->installedLocation));
            $applicationInfo->setStatus((string) $xmlAppInfo->status);

            foreach ($xmlAppInfo->servers->applicationServer as $xmlServer) {
                $server = new \ZendServerAPI\DataTypes\ApplicationServer();
                $server->setId((string) $xmlServer->id);
                $server->setDeployedVersion((string) trim($xmlServer->deployedVersion));
                $server->setStatus((string) $xmlServer->status);
                $applicationInfo->addServer($server);
            }
            foreach ($xmlAppInfo->deployedVersions->deployedVersion as $xmlDeployedVersions) {
                $deployedVersions = new \ZendServerAPI\DataTypes\DeployedVersions();
                $deployedVersions->setVersion((string) trim($xmlDeployedVersions));
                $applicationInfo->addDeployedVersions($deployedVersions);
            }

            $messageListMapper = new \ZendServerAPI\Mapper\MessageList();
            $xmlMessageList = (string) $xmlAppInfo->messageList;

            if(!empty($xmlMessageList))
                $applicationInfo->setMessageList($messageListMapper->parse($xmlMessageList));

            $applicationList->addApplicationInfo($applicationInfo);
        }

        return $applicationList;
    }
}
