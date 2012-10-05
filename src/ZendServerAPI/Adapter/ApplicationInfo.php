<?php
namespace ZendServerAPI\Adapter;

class ApplicationInfo extends Adapter
{
    /**
     * @see \ZendServerAPI\Adapter\Adapter::parse()
     */
    public function parse ($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);

        $applicationInfo = new \ZendServerAPI\DataTypes\ApplicationInfo();
        $applicationInfo->setAppName((string) $xml->responseData->applicationInfo->appName);
        $applicationInfo->setId((string) $xml->responseData->applicationInfo->id);
        $applicationInfo->setBaseUrl((string) $xml->responseData->applicationInfo->baseUrl);
        $applicationInfo->setUserAppName((string) $xml->responseData->applicationInfo->userAppName);
        $applicationInfo->setInstalledlocation((string) trim($xml->responseData->applicationInfo->installedLocation));
        $applicationInfo->setStatus((string) $xml->responseData->applicationInfo->status);

        if (isset($xml->responseData->applicationInfo->servers->applicationServer)) {
            foreach ($xml->responseData->applicationInfo->servers->applicationServer as $xmlServer) {
                $server = new \ZendServerAPI\DataTypes\ApplicationServer();
                $server->setId((string) $xmlServer->id);
                $server->setDeployedVersion((string) trim($xmlServer->deployedVersion));
                $server->setStatus((string) $xmlServer->status);
                $applicationInfo->addServer($server);
            }
        }
        if (isset($xml->responseData->applicationInfo->deployedVersions->deployedVersion)) {
            foreach ($xml->responseData->applicationInfo->deployedVersions->deployedVersion as $xmlDeployedVersions) {
                $deployedVersions = new \ZendServerAPI\DataTypes\DeployedVersions();
                $deployedVersions->setVersion((string) trim($xmlDeployedVersions));
                $applicationInfo->addDeployedVersions($deployedVersions);
            }
        }

        $messageListAdapter = new \ZendServerAPI\Adapter\MessageList();
        $xmlMessageList = (string) $xml->responseData->applicationInfo->messageList;

        if(!empty($xmlMessageList))
            $applicationInfo->setMessageList($messageListAdapter->parse($xmlMessageList));

        return $applicationInfo;
    }
}
