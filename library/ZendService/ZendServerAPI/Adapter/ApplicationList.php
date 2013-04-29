<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright      Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @package        Zend_Service
 */

namespace ZendService\ZendServerAPI\Adapter;

/**
 * ApplicationList datatype adapter implementation
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class ApplicationList extends Adapter
{
    /**
     * Parse the xml response in object mappings
     *
     * @param  string                                               $xml
     * @return \ZendService\ZendServerAPI\DataTypes\ApplicationList
     */
    public function parse ($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $this->setContent($xml);
        $xmlApplicationInfo = $this->getElements("//applicationInfo");

        $applicationList = new  \ZendService\ZendServerAPI\DataTypes\ApplicationList();

        foreach ($xmlApplicationInfo as $xmlAppInfo) {

            $applicationInfo = new  \ZendService\ZendServerAPI\DataTypes\ApplicationInfo();
            $applicationInfo->setAppName((string) $xmlAppInfo->appName);
            $applicationInfo->setId((string) $xmlAppInfo->id);
            $applicationInfo->setBaseUrl((string) $xmlAppInfo->baseUrl);
            $applicationInfo->setUserAppName((string) $xmlAppInfo->userAppName);
            $applicationInfo->setInstalledlocation((string) trim($xmlAppInfo->installedLocation));
            $applicationInfo->setStatus((string) $xmlAppInfo->status);

            foreach ($xmlAppInfo->servers->applicationServer as $xmlServer) {

                $server = new  \ZendService\ZendServerAPI\DataTypes\ApplicationServer();
                $server->setId((string) $xmlServer->id);
                $server->setDeployedVersion((string) trim($xmlServer->deployedVersion));
                $server->setStatus((string) $xmlServer->status);
                $applicationInfo->addServer($server);

            }
            $deployedVersions = new  \ZendService\ZendServerAPI\DataTypes\DeployedVersions();
            $deployedVersions->setVersion((string) trim($xmlAppInfo->deployedVersion));
            $applicationInfo->addDeployedVersions($deployedVersions);

            $messageListAdapter = new  \ZendService\ZendServerAPI\Adapter\MessageList();
            $xmlMessageList = (string) $xmlAppInfo->messageList;

            if (!empty($xmlMessageList)) {
                $applicationInfo->setMessageList($messageListAdapter->parse($xmlMessageList));
            }

            $applicationList->addApplicationInfo($applicationInfo);
        }

        return $applicationList;
    }
}
