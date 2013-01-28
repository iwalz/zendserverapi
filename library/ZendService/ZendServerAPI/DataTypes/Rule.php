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
 * Rule model implementation.
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class Rule extends DataType
{
    /**
     * @var int
     */
    protected $id = null;
    /**
     * @var string
     */
    protected $type = null;
    /**
     * @var string
     */
    protected $queueName = null;
    /**
     * @var string
     */
    protected $status = null;
    /**
     * @var string
     */
    protected $priority = null;
    /**
     * @var string
     */
    protected $persistent = null;
    /**
     * @var string
     */
    protected $script = null;
    /**
     * @var string
     */
    protected $name = null;
    /**
     * @var array
     */
    protected $vars = array();
    /**
     * @var array
     */
    protected $httpHeaders = array();
    /**
     * @var string
     */
    protected $appId = null;
    /**
     * @var string
     */
    protected $lastRun = null;
    /**
     * @var string
     */
    protected $nextRun = null;

    /**
     * @param string $appId
     */
    public function setAppId($appId)
    {
        $this->appId = $appId;
    }

    /**
     * @return string
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * @param array $httpHeaders
     */
    public function setHttpHeaders($httpHeaders)
    {
        $this->httpHeaders = $httpHeaders;
    }

    /**
     * @return array
     */
    public function getHttpHeaders()
    {
        return $this->httpHeaders;
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
     * @param string $lastRun
     */
    public function setLastRun($lastRun)
    {
        $this->lastRun = $lastRun;
    }

    /**
     * @return string
     */
    public function getLastRun()
    {
        return $this->lastRun;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $nextRun
     */
    public function setNextRun($nextRun)
    {
        $this->nextRun = $nextRun;
    }

    /**
     * @return string
     */
    public function getNextRun()
    {
        return $this->nextRun;
    }

    /**
     * @param string $persistent
     */
    public function setPersistent($persistent)
    {
        $this->persistent = $persistent;
    }

    /**
     * @return string
     */
    public function getPersistent()
    {
        return $this->persistent;
    }

    /**
     * @param string $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    /**
     * @return string
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param string $queueName
     */
    public function setQueueName($queueName)
    {
        $this->queueName = $queueName;
    }

    /**
     * @return string
     */
    public function getQueueName()
    {
        return $this->queueName;
    }

    /**
     * @param string $script
     */
    public function setScript($script)
    {
        $this->script = $script;
    }

    /**
     * @return string
     */
    public function getScript()
    {
        return $this->script;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param array $vars
     */
    public function setVars($vars)
    {
        $this->vars = $vars;
    }

    /**
     * @return array
     */
    public function getVars()
    {
        return $this->vars;
    }
}
