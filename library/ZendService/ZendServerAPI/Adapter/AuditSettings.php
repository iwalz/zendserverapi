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
 * Transform Filter-XML datatype to \ZendService\ZendServerAPI\DataTypes\Filter
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class AuditSettings extends Adapter
{
    /**
     * Parse the xml response in object mappings
     *
     * @return \ZendService\ZendServerAPI\DataTypes\DataType
     */
    public function parse ($xml = null)
    {
        if ($xml === null) {
            $xml = $this->getResponse()->getBody();
        }

        $this->setContent($xml);
        $xmlAuditSetting = $this->getElement("//auditSettings");

        $auditSettings = new \ZendService\ZendServerAPI\DataTypes\AuditSettings();
        $auditSettings->setSendToMail((string) $xmlAuditSetting->sendToMail);
        $auditSettings->setSendToUrl((string) $xmlAuditSetting->sendToUrl);
        $auditSettings->setHistory((int) $xmlAuditSetting->history);

        return $auditSettings;
    }

}
