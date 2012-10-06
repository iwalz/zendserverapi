<?php
namespace ZendServerAPI\DataTypes;

class IssueDetails
{
    /**
     * The issue
     * @var \ZendServerAPI\DataTypes\Issue
     */
    protected $issue = null;
    /**
     * The event Group
     * @var array
     */
    protected $eventsGroups = array();
    
    public function __construct()
    {

    }
	/**
     * @return the $issue
     */
    public function getIssue ()
    {
        return $this->issue;
    }

	/**
     * @return the $eventsGroups
     */
    public function getEventsGroups ()
    {
        return $this->eventsGroups;
    }

	/**
     * @param \ZendServerAPI\DataTypes\Issue $issue
     */
    public function setIssue (\ZendServerAPI\DataTypes\Issue $issue)
    {
        $this->issue = $issue;
    }

	/**
     * @param \ZendServerAPI\DataTypes\EventsGroup $eventsGroup
     */
    public function addEventsGroup (\ZendServerAPI\DataTypes\EventsGroup $eventsGroup)
    {
        $this->eventsGroups[] = $eventsGroup;
    }

}
