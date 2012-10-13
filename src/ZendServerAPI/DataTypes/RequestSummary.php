<?php
namespace ZendServerAPI\DataTypes;

class RequestSummary
{
    protected $eventsCount = null;
    protected $codeTracing = null;
    protected $events = array();

    public function __construct()
    {

    }
	/**
     * @return the $eventsCount
     */
    public function getEventsCount ()
    {
        return $this->eventsCount;
    }

	/**
     * @return the $codeTracing
     */
    public function getCodeTracing ()
    {
        return $this->codeTracing;
    }

	/**
     * @return the $events
     */
    public function getEvents ()
    {
        return $this->events;
    }

	/**
     * @param NULL $eventsCount
     */
    public function setEventsCount ($eventsCount)
    {
        $this->eventsCount = (int)$eventsCount;
    }

	/**
     * @param NULL $codeTracing
     */
    public function setCodeTracing ($codeTracing)
    {
        $this->codeTracing = $codeTracing;
    }

	/**
     * @param multitype: $events
     */
    public function addEvents ($events)
    {
        $this->events[] = $events;
    }

}
