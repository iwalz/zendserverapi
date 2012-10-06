<?php
namespace ZendServerAPI\DataTypes;

class EventsGroupDetails
{
    /**
     * The issue ID
     * @var Integer
     */
    protected $issueId = null;
    /**
     * Basic detail about the events group
     * @var \ZendServerAPI\DataTypes\EventsGroup
     */
    protected $eventsGroup = null;
    /**
     * Basic detail about the event group
     * @var \ZendServerAPI\DataTypes\Event
     */
    protected $event = null;
    /**
     * Associated code tracing identifier
     * @var string
     */
    protected $codeTracing = null;
    
    public function __construct()
    {

    }
	/**
     * @return the $issueId
     */
    public function getIssueId ()
    {
        return $this->issueId;
    }

	/**
     * @return the $eventsGroup
     */
    public function getEventsGroup ()
    {
        return $this->eventsGroup;
    }

	/**
     * @return the $event
     */
    public function getEvent ()
    {
        return $this->event;
    }

	/**
     * @return the $codeTracing
     */
    public function getCodeTracing ()
    {
        return $this->codeTracing;
    }

	/**
     * @param NULL $issueId
     */
    public function setIssueId ($issueId)
    {
        $this->issueId = $issueId;
    }

	/**
     * @param NULL $eventsGroup
     */
    public function setEventsGroup (\ZendServerAPI\DataTypes\EventsGroup $eventsGroup)
    {
        $this->eventsGroup = $eventsGroup;
    }

	/**
     * @param NULL $event
     */
    public function setEvent (\ZendServerAPI\DataTypes\Event $event)
    {
        $this->event = $event;
    }

	/**
     * @param NULL $codeTracing
     */
    public function setCodeTracing ($codeTracing)
    {
        $this->codeTracing = $codeTracing;
    }

}
