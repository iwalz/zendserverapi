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
 *
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class AuditMessages extends Adapter
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
        $xmlAuditMessages = $this->getElements("//auditMessage");

        $auditMessages = new \ZendService\ZendServerAPI\DataTypes\AuditMessages();

        foreach ($xmlAuditMessages as $xmlAuditMessage) {
            $auditMessage = new \ZendService\ZendServerAPI\DataTypes\AuditMessage();

            $auditMessage->setId((int) $xmlAuditMessage->id);
            $auditMessage->setUsername((string)$xmlAuditMessage->username);
            $auditMessage->setRequestInterface((string)$xmlAuditMessage->requestInterface);
            $auditMessage->setRemoteAddr((string)$xmlAuditMessage->remoteAddr);
            $auditMessage->setAuditType((string)$xmlAuditMessage->auditType);
            $auditMessage->setAuditTypeTranslated((string)$xmlAuditMessage->auditTypeTranslated);
            $auditMessage->setBaseUrl((string)$xmlAuditMessage->baseUrl);
            $auditMessage->setCreationTime((string)$xmlAuditMessage->creationTime);
            $auditMessage->setCreationTimeTimestramp((string)$xmlAuditMessage->creationTimeTimestamp);
            $auditMessage->setOutcome((string)$xmlAuditMessage->outcome);

            if (isset($xmlAuditMessage->extraData->extraDataMessage)) {

                $extraData = array();
                foreach ($xmlAuditMessage->extraData->extraDataMessage->parameter as $parameter) {
                    $extraData[(string)$parameter->name] = (string)$parameter->value;
                }

                $auditMessage->setExtraData($extraData);
            }

            $auditMessages->addAuditMessage($auditMessage);
        }

        return $auditMessages;
    }
}
