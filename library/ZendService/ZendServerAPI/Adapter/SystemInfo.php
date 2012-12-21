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
        $this->setContent($xml);
        
        $xmlSystemInfo = $this->getElement("//systemInfo");
        
        $systemInfo = new SystemInfoData();
        $systemInfo->setStatus((string) $xmlSystemInfo->status);
        $systemInfo->setEdition((string) $xmlSystemInfo->edition);
        $systemInfo->setZendServerVersion((string) $xmlSystemInfo->zendServerVersion);
        $systemInfo->setSupportedApiVersions((string) trim($xmlSystemInfo->supportedApiVersions));
        $systemInfo->setPhpVersion((string) $xmlSystemInfo->phpVersion);
        $systemInfo->setOperatingSystem((string) $xmlSystemInfo->operatingSystem);
        $systemInfo->setDeploymentVersion((string) $xmlSystemInfo->deploymentVersion);

        $serverLicenseInfo = new LicenseInfo();
        $serverLicenseInfo->setStatus((string) $xmlSystemInfo->serverLicenseInfo->status);
        $serverLicenseInfo->setOrderNumber((string) $xmlSystemInfo->serverLicenseInfo->orderNumber);
        $serverLicenseInfo->setValidUntil((string) $xmlSystemInfo->serverLicenseInfo->validUntil);
        $serverLicenseInfo->setServerLimit((string) $xmlSystemInfo->serverLicenseInfo->serverLimit);
        $systemInfo->setServerLicenseInfo($serverLicenseInfo);

        $managerLicenseInfo = new LicenseInfo();
        $managerLicenseInfo->setStatus((string) $xmlSystemInfo->managerLicenseInfo->status);
        $managerLicenseInfo->setOrderNumber((string) $xmlSystemInfo->managerLicenseInfo->orderNumber);
        $managerLicenseInfo->setValidUntil((string) $xmlSystemInfo->managerLicenseInfo->validUntil);
        $managerLicenseInfo->setServerLimit((string) $xmlSystemInfo->managerLicenseInfo->serverLimit);
        $systemInfo->setManagerLicenseInfo($managerLicenseInfo);

        $messageListAdapter = new  \ZendService\ZendServerAPI\Adapter\MessageList();
        $messageList = $messageListAdapter->parse((string) $xmlSystemInfo->messageList);
        $systemInfo->setMessageList($messageList);

        return $systemInfo;
    }
}
