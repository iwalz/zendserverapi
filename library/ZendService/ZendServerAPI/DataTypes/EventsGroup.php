<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link 		http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright 	Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license 	http://framework.zend.com/license/new-bsd New BSD License
 * @package 	Zend_Service
 */

namespace ZendService\ZendServerAPI\DataTypes;

/**
 * EventsGroup model implementation.
 *
 * @license	    http://framework.zend.com/license/new-bsd New BSD License
 * @link		http://github.com/zendframework/zf2 for the canonical source repository
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @category	Zend
 * @package	    Zend_Service
 * @subpackage	ZendServerAPI
 */
class EventsGroup extends DataType
{
    /**
     * Event Group's identifier
     * @var string
     */
    protected $eventsGroupId = null;
    /**
     * The number of events in the
     * current event group
     * @var int
     */
    protected $eventsCount = null;
    /**
     * Timestamp for the first event in the current event-group
     * @var int
     */
    protected $startTime = null;
    /**
     * Identifier of the cluster-member where the event took
     * place. This field will be empty if no serverID is applicable
     * @var int
     */
    protected $serverId = null;
    /**
     * The class in which the event occured
     * @var string
     */
    protected $class = null;
    /**
     * User specific data (Cookies etc)
     * @var string
     */
    protected $userData = null;
    /**
     * Backtrace if happened with the java bridge
     * @var string
     */
    protected $javaBacktrace = null;
    /**
     * Execution time
     * @var int
     */
    protected $execTime = null;
    /**
     * Average execution time
     * @var int
     */
    protected $avgExecTime = null;
    /**
     * Memory usage
     * @var int
     */
    protected $memUsage = null;
    /**
     * Average memory usage
     * @var int
     */
    protected $avgMemUsage = null;
    /**
     * Average output size
     * @var int
     */
    protected $avgOutputSize = null;
    /**
     * Load
     * @var string
     */
    protected $load = null;

    /**
     * Get the event group's id
     *
     * @return string
     */
    public function getEventsGroupId ()
    {
        return $this->eventsGroupId;
    }

    /**
     * Get the number of events in the current
     * event group
     *
     * @return int
     */
    public function getEventsCount ()
    {
        return $this->eventsCount;
    }

    /**
     * Get the timestamp for the first event in the current event-group
     *
     * @return int
     */
    public function getStartTime ()
    {
        return $this->startTime;
    }

    /**
     * Get the identifier of the cluster-member where the event took
     * place. This field will be empty if no serverID is applicable
     *
     * @return int
     */
    public function getServerId ()
    {
        return $this->serverId;
    }

    /**
     * Get the class in which the event occured
     *
     * @return string
     */
    public function getClass ()
    {
        return $this->class;
    }

    /**
     * Get the user specific data (Cookies etc)
     *
     * @return string
     */
    public function getUserData ()
    {
        return $this->userData;
    }

    /**
     * Get the backtrace if happened with the java bridge
     *
     * @return string
     */
    public function getJavaBacktrace ()
    {
        return $this->javaBacktrace;
    }

    /**
     * Get the execution time
     *
     * @return int
     */
    public function getExecTime ()
    {
        return $this->execTime;
    }

    /**
     * Get the average execution time
     *
     * @return int
     */
    public function getAvgExecTime ()
    {
        return $this->avgExecTime;
    }

    /**
     * Get the memory usage
     *
     * @return int
     */
    public function getMemUsage ()
    {
        return $this->memUsage;
    }

    /**
     * Get the average memory usage
     *
     * @return int
     */
    public function getAvgMemUsage ()
    {
        return $this->avgMemUsage;
    }

    /**
     * Get the average output size
     *
     * @return int
     */
    public function getAvgOutputSize ()
    {
        return $this->avgOutputSize;
    }

    /**
     * Get the load
     *
     * @return string
     */
    public function getLoad ()
    {
        return $this->load;
    }

    /**
     * Set the event group's id
     *
     * @param  string $eventsGroupId
     * @return void
     */
    public function setEventsGroupId ($eventsGroupId)
    {
        $this->eventsGroupId = $eventsGroupId;
    }

    /**
     * Set the number of events in the current event-group
     *
     * @param  int  $eventsCount
     * @return void
     */
    public function setEventsCount ($eventsCount)
    {
        $this->eventsCount = (int) $eventsCount;
    }

    /**
     * Set the start time
     *
     * @param  int  $startTime
     * @return void
     */
    public function setStartTime ($startTime)
    {
        $this->startTime = (int) $startTime;
    }

    /**
     * Set the identifier of the cluster-member where the event took
     * place. This field will be empty if no serverID is applicable
     *
     * @param  int  $serverId
     * @return void
     */
    public function setServerId ($serverId)
    {
        $this->serverId = (int) $serverId;
    }

    /**
     * Set the class in which the event occured
     *
     * @param  string $class
     * @return void
     */
    public function setClass ($class)
    {
        $this->class = $class;
    }

    /**
     * Set the user specific data (Cookies etc)
     *
     * @param  string $userData
     * @return void
     */
    public function setUserData ($userData)
    {
        $this->userData = $userData;
    }

    /**
     * Set the backtrace if happened with the java bridge
     *
     * @param  string $javaBacktrace
     * @return void
     */
    public function setJavaBacktrace ($javaBacktrace)
    {
        $this->javaBacktrace = $javaBacktrace;
    }

    /**
     * Set the execution time
     *
     * @param  int  $execTime
     * @return void
     */
    public function setExecTime ($execTime)
    {
        $this->execTime = (int) $execTime;
    }

    /**
     * Set the average execution time
     *
     * @param  int  $avgExecTime
     * @return void
     */
    public function setAvgExecTime ($avgExecTime)
    {
        $this->avgExecTime = (int) $avgExecTime;
    }

    /**
     * Set the memory usage
     *
     * @param  int  $memUsage
     * @return void
     */
    public function setMemUsage ($memUsage)
    {
        $this->memUsage = (int) $memUsage;
    }

    /**
     * Set the average memory usage
     *
     * @param  int  $avgMemUsage
     * @return void
     */
    public function setAvgMemUsage ($avgMemUsage)
    {
        $this->avgMemUsage = (int) $avgMemUsage;
    }

    /**
     * Set the average output size
     *
     * @param  int  $avgOutputSize
     * @return void
     */
    public function setAvgOutputSize ($avgOutputSize)
    {
        $this->avgOutputSize = (int) $avgOutputSize;
    }

    /**
     * Set the load
     *
     * @param  string $load
     * @return void
     */
    public function setLoad ($load)
    {
        $this->load = $load;
    }

}
