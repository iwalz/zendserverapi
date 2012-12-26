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
 *
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class AuditMessage extends DataType
{
    /**
     * @var int
     */
    protected $id = null;
    /**
     * @var string
     */
    protected $username = null;
    /**
     * @var string
     */
    protected $requestInterface = null;
    /**
     * @var string
     */
    protected $remoteAddr = null;
    /**
     * @var string
     */
    protected $auditType = null;
    /**
     * @var string
     */
    protected $auditTypeTranslated = null;
    /**
     * @var string
     */
    protected $baseUrl = null;
    /**
     * @var string
     */
    protected $creationTime = null;
    /**
     * @var int
     */
    protected $creationTimeTimestramp = null;
    /**
     * @var array
     */
    protected $extraData = array();
    /**
     * @var string
     */
    protected $outcome = null;

    /**
     * @param string $auditType
     */
    public function setAuditType($auditType)
    {
        $this->auditType = $auditType;
    }

    /**
     * @return string
     */
    public function getAuditType()
    {
        return $this->auditType;
    }

    /**
     * @param string $auditTypeTranslated
     */
    public function setAuditTypeTranslated($auditTypeTranslated)
    {
        $this->auditTypeTranslated = $auditTypeTranslated;
    }

    /**
     * @return string
     */
    public function getAuditTypeTranslated()
    {
        return $this->auditTypeTranslated;
    }

    /**
     * @param string $baseUrl
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
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
     * @param int $creationTimeTimestramp
     */
    public function setCreationTimeTimestramp($creationTimeTimestramp)
    {
        $this->creationTimeTimestramp = $creationTimeTimestramp;
    }

    /**
     * @return int
     */
    public function getCreationTimeTimestramp()
    {
        return $this->creationTimeTimestramp;
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
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $outcome
     */
    public function setOutcome($outcome)
    {
        $this->outcome = $outcome;
    }

    /**
     * @return string
     */
    public function getOutcome()
    {
        return $this->outcome;
    }

    /**
     * @param string $remoteAddr
     */
    public function setRemoteAddr($remoteAddr)
    {
        $this->remoteAddr = $remoteAddr;
    }

    /**
     * @return string
     */
    public function getRemoteAddr()
    {
        return $this->remoteAddr;
    }

    /**
     * @param string $requestInterface
     */
    public function setRequestInterface($requestInterface)
    {
        $this->requestInterface = $requestInterface;
    }

    /**
     * @return string
     */
    public function getRequestInterface()
    {
        return $this->requestInterface;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

}

