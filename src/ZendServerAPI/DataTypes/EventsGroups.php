<?php
namespace ZendServerAPI\DataTypes;

class EventsGroups
{
    protected $eventGroups = array();

    public function addEventGroup(\ZendServerAPI\DataTypes\EventsGroup $eventGroup)
    {
        $this->eventGroups[] = $eventGroup;
    }

    public function getEventGroups()
    {
        return $this->eventGroups;
    }

    public function __construct()
    {

    }
}
