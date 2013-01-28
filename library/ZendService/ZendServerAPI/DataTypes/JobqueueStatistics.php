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
 * JobqueueStatistics model implementation.
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class JobqueueStatistics extends DataType
{
    /**
     * Number of jobs currently waiting to be processed
     * @var int
     */
    protected $waiting = null;
    /**
     * Number of jobs currently waiting on predecessor to finish execution so that they may begin
     * @var int
     */
    protected $waitingPredecessor = null;
    /**
     * Number of jobs currently in execution
     * @var int
     */
    protected $inProgress = null;
    /**
     * Number of jobs currently marked as completed
     * @var int
     */
    protected $completed = null;
    /**
     * Number of jobs currently marked as failed
     * @var int
     */
    protected $failed = null;
    /**
     * Number of jobs currently marked as failed during execution due to a signalled script error
     * @var int
     */
    protected $logicallyFailed = null;
    /**
     * Number of jobs currently marked as scheduled for execution
     * @var int
     */
    protected $scheduled = null;
    /**
     * The average wait time in seconds for jobs
     * @var int
     */
    protected $avgWait = null;
    /**
     * The average run time in seconds for jobs
     * @var int
     */
    protected $avgRun = null;
    /**
     * The number of offloaded jobs introduced to the Jobqueue throughout the lifetime of the daemon
     * @var int
     */
    protected $added = null;
    /**
     * The number of jobs executed by the Jobqueue throughout the lifetime of the daemon
     * @var int
     */
    protected $served = null;
    /**
     * The date and time the daemon’s lifetime started
     * @var string
     */
    protected $startupTime = null;
    /**
     * The unix timestamp the daemon’s lifetime started
     * @var int
     */
    protected $startupTimestamp = null;

    /**
     * @param int $added
     */
    public function setAdded($added)
    {
        $this->added = $added;
    }

    /**
     * @return int
     */
    public function getAdded()
    {
        return $this->added;
    }

    /**
     * @param int $avgRun
     */
    public function setAvgRun($avgRun)
    {
        $this->avgRun = $avgRun;
    }

    /**
     * @return int
     */
    public function getAvgRun()
    {
        return $this->avgRun;
    }

    /**
     * @param int $avgWait
     */
    public function setAvgWait($avgWait)
    {
        $this->avgWait = $avgWait;
    }

    /**
     * @return int
     */
    public function getAvgWait()
    {
        return $this->avgWait;
    }

    /**
     * @param int $completed
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;
    }

    /**
     * @return int
     */
    public function getCompleted()
    {
        return $this->completed;
    }

    /**
     * @param int $failed
     */
    public function setFailed($failed)
    {
        $this->failed = $failed;
    }

    /**
     * @return int
     */
    public function getFailed()
    {
        return $this->failed;
    }

    /**
     * @param int $inProgress
     */
    public function setInProgress($inProgress)
    {
        $this->inProgress = $inProgress;
    }

    /**
     * @return int
     */
    public function getInProgress()
    {
        return $this->inProgress;
    }

    /**
     * @param int $logicallyFailed
     */
    public function setLogicallyFailed($logicallyFailed)
    {
        $this->logicallyFailed = $logicallyFailed;
    }

    /**
     * @return int
     */
    public function getLogicallyFailed()
    {
        return $this->logicallyFailed;
    }

    /**
     * @param int $scheduled
     */
    public function setScheduled($scheduled)
    {
        $this->scheduled = $scheduled;
    }

    /**
     * @return int
     */
    public function getScheduled()
    {
        return $this->scheduled;
    }

    /**
     * @param int $served
     */
    public function setServed($served)
    {
        $this->served = $served;
    }

    /**
     * @return int
     */
    public function getServed()
    {
        return $this->served;
    }

    /**
     * @param string $startupTime
     */
    public function setStartupTime($startupTime)
    {
        $this->startupTime = $startupTime;
    }

    /**
     * @return string
     */
    public function getStartupTime()
    {
        return $this->startupTime;
    }

    /**
     * @param int $startupTimestamp
     */
    public function setStartupTimestamp($startupTimestamp)
    {
        $this->startupTimestamp = $startupTimestamp;
    }

    /**
     * @return int
     */
    public function getStartupTimestamp()
    {
        return $this->startupTimestamp;
    }

    /**
     * @param int $waiting
     */
    public function setWaiting($waiting)
    {
        $this->waiting = $waiting;
    }

    /**
     * @return int
     */
    public function getWaiting()
    {
        return $this->waiting;
    }

    /**
     * @param int $waitingPredecessor
     */
    public function setWaitingPredecessor($waitingPredecessor)
    {
        $this->waitingPredecessor = $waitingPredecessor;
    }

    /**
     * @return int
     */
    public function getWaitingPredecessor()
    {
        return $this->waitingPredecessor;
    }
}
