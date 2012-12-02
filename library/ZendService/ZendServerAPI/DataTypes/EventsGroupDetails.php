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
 * eventsGroupDetails
 *
 * Details about an issue's eventsGroup, including the actual event data.
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class EventsGroupDetails extends DataType
{
    /**
     * The issue ID
     * @var int
     */
    protected $issueId = null;
    /**
     * Basic detail about the events group
     * @var \ZendService\ZendServerAPI\DataTypes\EventsGroup
     */
    protected $eventsGroup = null;
    /**
     * Basic detail about the event group
     * @var \ZendService\ZendServerAPI\DataTypes\Event
     */
    protected $event = null;
    /**
     * Associated code tracing identifier
     * @var string
     */
    protected $codeTracing = null;

    /**
     * Get the issue ID
     *
     * @return int
     */
    public function getIssueId ()
    {
        return $this->issueId;
    }

    /**
     * Get the basic detail about the events group
     *
     * @return \ZendService\ZendServerAPI\DataTypes\EventsGroup
     */
    public function getEventsGroup ()
    {
        return $this->eventsGroup;
    }

    /**
     * Get the details about the event group
     *
     * @return \ZendService\ZendServerAPI\DataTypes\Event
     */
    public function getEvent ()
    {
        return $this->event;
    }

    /**
     * Get the associated code tracing identifier
     *
     * @return string
     */
    public function getCodeTracing ()
    {
        return $this->codeTracing;
    }

    /**
     * Set the issue ID
     *
     * @param int
     * @return void
     */
    public function setIssueId ($issueId)
    {
        $this->issueId = (int) $issueId;
    }

    /**
     * Set the basic detail about the events group
     *
     * @param  \ZendService\ZendServerAPI\DataTypes\EventsGroup $eventsGroup
     * @return void
     */
    public function setEventsGroup (\ZendService\ZendServerAPI\DataTypes\EventsGroup $eventsGroup)
    {
        $this->eventsGroup = $eventsGroup;
    }

    /**
     * Set the details about the event group
     *
     * @param  \ZendService\ZendServerAPI\DataTypes\Event $event
     * @return void
     */
    public function setEvent (\ZendService\ZendServerAPI\DataTypes\Event $event)
    {
        $this->event = $event;
    }

    /**
     * Set the associated code tracing identifier
     *
     * @param  string $codeTracing
     * @return void
     */
    public function setCodeTracing ($codeTracing)
    {
        $this->codeTracing = $codeTracing;
    }

}
