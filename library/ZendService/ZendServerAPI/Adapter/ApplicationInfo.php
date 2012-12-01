<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link 		http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright 	Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license 	http://framework.zend.com/license/new-bsd New BSD License
 * @package 	Zend_Service
 */

namespace ZendService\ZendServerAPI\Adapter;

/**
 * ApplicationInfo datatype adapter implementation
 *
 * @license	http://framework.zend.com/license/new-bsd New BSD License
 * @link		http://github.com/zendframework/zf2 for the canonical source repository
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @category	Zend
 * @package	Zend_Service
 * @subpackage	ZendServerAPI
 */
class ApplicationInfo extends Adapter
{
    /**
     * Parse the xml response in object mappings
     *
     * @param  string                                               $xml
     * @return \ZendService\ZendServerAPI\DataTypes\ApplicationInfo
     */
    public function parse ($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);

        $applicationInfo = new  \ZendService\ZendServerAPI\DataTypes\ApplicationInfo();
        $applicationInfo->setAppName((string) $xml->responseData->applicationInfo->appName);
        $applicationInfo->setId((string) $xml->responseData->applicationInfo->id);
        $applicationInfo->setBaseUrl((string) $xml->responseData->applicationInfo->baseUrl);
        $applicationInfo->setUserAppName((string) $xml->responseData->applicationInfo->userAppName);
        $applicationInfo->setInstalledlocation((string) trim($xml->responseData->applicationInfo->installedLocation));
        $applicationInfo->setStatus((string) $xml->responseData->applicationInfo->status);

        if (isset($xml->responseData->applicationInfo->servers->applicationServer)) {
            foreach ($xml->responseData->applicationInfo->servers->applicationServer as $xmlServer) {
                $server = new  \ZendService\ZendServerAPI\DataTypes\ApplicationServer();
                $server->setId((string) $xmlServer->id);
                $server->setDeployedVersion((string) trim($xmlServer->deployedVersion));
                $server->setStatus((string) $xmlServer->status);
                $applicationInfo->addServer($server);
            }
        }
        if (isset($xml->responseData->applicationInfo->deployedVersions->deployedVersion)) {
            foreach ($xml->responseData->applicationInfo->deployedVersions->deployedVersion as $xmlDeployedVersions) {
                $deployedVersions = new  \ZendService\ZendServerAPI\DataTypes\DeployedVersions();
                $deployedVersions->setVersion((string) trim($xmlDeployedVersions));
                $applicationInfo->addDeployedVersions($deployedVersions);
            }
        }

        $messageListAdapter = new  \ZendService\ZendServerAPI\Adapter\MessageList();
        $xmlMessageList = (string) $xml->responseData->applicationInfo->messageList;

        if(!empty($xmlMessageList))
            $applicationInfo->setMessageList($messageListAdapter->parse($xmlMessageList));

        return $applicationInfo;
    }
}
