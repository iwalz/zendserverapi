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
 * Job model implementation.
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class Job extends DataType
{
    /**
     * Job unique identifier
     * @var int
     */
    protected $id = null;
    /**
     * Name of the job or its creating rule
     * @var string
     */
    protected $name = null;
    /**
     * Name of the job’s assigned Queue.
     * A queue is a user defined and arbitrary context for the job
     * @var string
     */
    protected $queue = null;
    /**
     * Current job execution status.
     * One of (Pending, Waiting Predecessor, Running, Completed, Failed, OK, Logically Failed, Timeout,
     * Removed, Scheduled, Suspended)
     * @var string
     */
    protected $status = null;
    /**
     * Job’s execution priority. One of (Low, Normal, High, Urgent)
     * @var string
     */
    protected $priority = null;
    /**
     * Indicates if the job is a one-time execution or the result of a recurring job
     * @var bool
     */
    protected $persistent = null;
    /**
     * URL to be used for execution
     * @var string
     */
    protected $script = null;
    /**
     * ISO8061 formatted date and time
     * @var string
     */
    protected $creationTime = null;
    /**
     * ISO8061 formatted date and time
     * @var string
     */
    protected $startTime = null;
    /**
     * ISO8061 formatted date and time
     * @var string
     */
    protected $endTime = null;

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
     * @param string $endTime
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
    }

    /**
     * @return string
     */
    public function getEndTime()
    {
        return $this->endTime;
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
     * @param boolean $persistent
     */
    public function setPersistent($persistent)
    {
        $this->persistent = $persistent;
    }

    /**
     * @return boolean
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
     * @param string $queue
     */
    public function setQueue($queue)
    {
        $this->queue = $queue;
    }

    /**
     * @return string
     */
    public function getQueue()
    {
        return $this->queue;
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
     * @param string $startTime
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }

    /**
     * @return string
     */
    public function getStartTime()
    {
        return $this->startTime;
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
}
