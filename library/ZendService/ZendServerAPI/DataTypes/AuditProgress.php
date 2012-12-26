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
 * AuditProgress model implementation.
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class AuditProgress extends DataType
{
    /**
     * @var int
     */
    protected $progressId = null;
    /**
     * @var int
     */
    protected $auditId = null;
    /**
     * @var int
     */
    protected $serverId = null;
    /**
     * @var string
     */
    protected $serverIp = null;
    /**
     * @var string
     */
    protected $serverName = null;
    /**
     * @var string
     */
    protected $creationTime = null;
    /**
     * @var string
     */
    protected $progress = null;
    /**
     * @var array
     */
    protected $extraData = array();

    /**
     * @param int $auditId
     */
    public function setAuditId($auditId)
    {
        $this->auditId = $auditId;
    }

    /**
     * @return int
     */
    public function getAuditId()
    {
        return $this->auditId;
    }

    /**
     * @param string $creationTime
     */
    public function setCreationTime($creationTime)
    {
        $this->creationTime = $creationTime;
    }

    /**
     * @return string
     */
    public function getCreationTime()
    {
        return $this->creationTime;
    }

    /**
     * @param array $extraData
     */
    public function setExtraData($extraData)
    {
        $this->extraData = $extraData;
    }

    /**
     * @return array
     */
    public function getExtraData()
    {
        return $this->extraData;
    }

    /**
     * @param string $progress
     */
    public function setProgress($progress)
    {
        $this->progress = $progress;
    }

    /**
     * @return string
     */
    public function getProgress()
    {
        return $this->progress;
    }

    /**
     * @param int $progressId
     */
    public function setProgressId($progressId)
    {
        $this->progressId = $progressId;
    }

    /**
     * @return int
     */
    public function getProgressId()
    {
        return $this->progressId;
    }

    /**
     * @param int $serverId
     */
    public function setServerId($serverId)
    {
        $this->serverId = $serverId;
    }

    /**
     * @return int
     */
    public function getServerId()
    {
        return $this->serverId;
    }

    /**
     * @param string $serverIp
     */
    public function setServerIp($serverIp)
    {
        $this->serverIp = $serverIp;
    }

    /**
     * @return string
     */
    public function getServerIp()
    {
        return $this->serverIp;
    }

    /**
     * @param string $serverName
     */
    public function setServerName($serverName)
    {
        $this->serverName = $serverName;
    }

    /**
     * @return string
     */
    public function getServerName()
    {
        return $this->serverName;
    }

}
