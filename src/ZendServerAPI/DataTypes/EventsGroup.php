<?php
namespace ZendServerAPI\DataTypes;

class EventsGroup
{
    protected $eventsGroupId = null;
    protected $eventsCount = null;
    protected $startTime = null;
    protected $serverId = null;
    protected $class = null;
    protected $userData = null;
    protected $javaBacktrace = null;
    protected $execTime = null;
    protected $avgExecTime = null;
    protected $memUsage = null;
    protected $avgMemUsage = null;
    protected $avgOutputSize = null;
    protected $load = null;

    public function __construct()
    {

    }
    /**
     * @return the $eventsGroupId
     */
    public function getEventsGroupId ()
    {
        return $this->eventsGroupId;
    }

    /**
     * @return the $eventsCount
     */
    public function getEventsCount ()
    {
        return $this->eventsCount;
    }

    /**
     * @return the $startTime
     */
    public function getStartTime ()
    {
        return $this->startTime;
    }

    /**
     * @return the $serverId
     */
    public function getServerId ()
    {
        return $this->serverId;
    }

    /**
     * @return the $class
     */
    public function getClass ()
    {
        return $this->class;
    }

    /**
     * @return the $userData
     */
    public function getUserData ()
    {
        return $this->userData;
    }

    /**
     * @return the $javaBacktrace
     */
    public function getJavaBacktrace ()
    {
        return $this->javaBacktrace;
    }

    /**
     * @return the $execTime
     */
    public function getExecTime ()
    {
        return $this->execTime;
    }

    /**
     * @return the $avgExecTime
     */
    public function getAvgExecTime ()
    {
        return $this->avgExecTime;
    }

    /**
     * @return the $memUsage
     */
    public function getMemUsage ()
    {
        return $this->memUsage;
    }

    /**
     * @return the $avgMemUsage
     */
    public function getAvgMemUsage ()
    {
        return $this->avgMemUsage;
    }

    /**
     * @return the $avgOutputSize
     */
    public function getAvgOutputSize ()
    {
        return $this->avgOutputSize;
    }

    /**
     * @return the $load
     */
    public function getLoad ()
    {
        return $this->load;
    }

    /**
     * @param NULL $eventsGroupId
     */
    public function setEventsGroupId ($eventsGroupId)
    {
        $this->eventsGroupId = $eventsGroupId;
    }

    /**
     * @param NULL $eventsCount
     */
    public function setEventsCount ($eventsCount)
    {
        $this->eventsCount = $eventsCount;
    }

    /**
     * @param NULL $startTime
     */
    public function setStartTime ($startTime)
    {
        $this->startTime = $startTime;
    }

    /**
     * @param NULL $serverId
     */
    public function setServerId ($serverId)
    {
        $this->serverId = $serverId;
    }

    /**
     * @param NULL $class
     */
    public function setClass ($class)
    {
        $this->class = $class;
    }

    /**
     * @param NULL $userData
     */
    public function setUserData ($userData)
    {
        $this->userData = $userData;
    }

    /**
     * @param NULL $javaBacktrace
     */
    public function setJavaBacktrace ($javaBacktrace)
    {
        $this->javaBacktrace = $javaBacktrace;
    }

    /**
     * @param NULL $execTime
     */
    public function setExecTime ($execTime)
    {
        $this->execTime = $execTime;
    }

    /**
     * @param NULL $avgExecTime
     */
    public function setAvgExecTime ($avgExecTime)
    {
        $this->avgExecTime = $avgExecTime;
    }

    /**
     * @param NULL $memUsage
     */
    public function setMemUsage ($memUsage)
    {
        $this->memUsage = $memUsage;
    }

    /**
     * @param NULL $avgMemUsage
     */
    public function setAvgMemUsage ($avgMemUsage)
    {
        $this->avgMemUsage = $avgMemUsage;
    }

    /**
     * @param NULL $avgOutputSize
     */
    public function setAvgOutputSize ($avgOutputSize)
    {
        $this->avgOutputSize = $avgOutputSize;
    }

    /**
     * @param NULL $load
     */
    public function setLoad ($load)
    {
        $this->load = $load;
    }

}
