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

use \ZendService\ZendServerAPI\DataTypes\LicenseInfo,
    \ZendService\ZendServerAPI\DataTypes\MessageList as MessageListData,
    \ZendService\ZendServerAPI\DataTypes\SystemInfo as SystemInfoData;

/**
 * SystemInfo datatype adapter implementation
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class SystemInfo extends Adapter
{
    /**
     * Parse the xml response in object mappings
     *
     * @param  string                                          $xml
     * @return \ZendService\ZendServerAPI\DataTypes\SystemInfo
     */
    public function parse($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);
        $systemInfo = new SystemInfoData();
        $systemInfo->setStatus((string) $xml->responseData->systemInfo->status);
        $systemInfo->setEdition((string) $xml->responseData->systemInfo->edition);
        $systemInfo->setZendServerVersion((string) $xml->responseData->systemInfo->zendServerVersion);
        $systemInfo->setSupportedApiVersions((string) trim($xml->responseData->systemInfo->supportedApiVersions));
        $systemInfo->setPhpVersion((string) $xml->responseData->systemInfo->phpVersion);
        $systemInfo->setOperatingSystem((string) $xml->responseData->systemInfo->operatingSystem);
        $systemInfo->setDeploymentVersion((string) $xml->responseData->systemInfo->deploymentVersion);

        $serverLicenseInfo = new LicenseInfo();
        $serverLicenseInfo->setStatus((string) $xml->responseData->systemInfo->serverLicenseInfo->status);
        $serverLicenseInfo->setOrderNumber((string) $xml->responseData->systemInfo->serverLicenseInfo->orderNumber);
        $serverLicenseInfo->setValidUntil((string) $xml->responseData->systemInfo->serverLicenseInfo->validUntil);
        $serverLicenseInfo->setServerLimit((string) $xml->responseData->systemInfo->serverLicenseInfo->serverLimit);
        $systemInfo->setServerLicenseInfo($serverLicenseInfo);

        $managerLicenseInfo = new LicenseInfo();
        $managerLicenseInfo->setStatus((string) $xml->responseData->systemInfo->managerLicenseInfo->status);
        $managerLicenseInfo->setOrderNumber((string) $xml->responseData->systemInfo->managerLicenseInfo->orderNumber);
        $managerLicenseInfo->setValidUntil((string) $xml->responseData->systemInfo->managerLicenseInfo->validUntil);
        $managerLicenseInfo->setServerLimit((string) $xml->responseData->systemInfo->managerLicenseInfo->serverLimit);
        $systemInfo->setManagerLicenseInfo($managerLicenseInfo);

        $messageListAdapter = new  \ZendService\ZendServerAPI\Adapter\MessageList();
        $messageList = $messageListAdapter->parse((string) $xml->responseData->messageList);
        $systemInfo->setMessageList($messageList);

        return $systemInfo;
    }
}
