<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright      Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @package        Zend_Service
 */
namespace ZendService\ZendServerAPI\DataTypes;

/**
 * AuditMessageDetails model implementation.
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class AuditMessageDetails extends DataType
{
    /**
     * @var AuditMessage
     */
    protected $auditMessage = null;
    /**
     * @var AuditProgress
     */
    protected $auditProgress = null;

    /**
     * @param \ZendService\ZendServerAPI\DataTypes\AuditMessage $auditMessage
     */
    public function setAuditMessage(AuditMessage $auditMessage)
    {
        $this->auditMessage = $auditMessage;
    }

    /**
     * @return \ZendService\ZendServerAPI\DataTypes\AuditMessage
     */
    public function getAuditMessage()
    {
        return $this->auditMessage;
    }

    /**
     * @param \ZendService\ZendServerAPI\DataTypes\AuditProgress $auditProgress
     */
    public function setAuditProgress(AuditProgress $auditProgress)
    {
        $this->auditProgress = $auditProgress;
    }

    /**
     * @return \ZendService\ZendServerAPI\DataTypes\AuditProgress
     */
    public function getAuditProgress()
    {
        return $this->auditProgress;
    }

}
