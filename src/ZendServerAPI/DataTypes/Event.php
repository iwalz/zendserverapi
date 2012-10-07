<?php
namespace ZendServerAPI\DataTypes;

class Event
{
    /**
     * Issue type name
     * @var string
     */
    protected $type = null;
    /**
     * Free text field with detail about the issue
     * @var string
     */
    protected $description = null;
    /**
     * Super globals array and their values:
     * get,post,cookie,session,server
     * @var \ZendServerAPI\DataTypes\SuperGlobals
     */
    protected $superglobals = null;
    /**
     * Url for the debugging event
     * @var string
     */
    protected $debugUrl = null;
    /**
     * Severity indicator for the event:
     * Info, Warning, Critical
     * @var string
     */
    protected $severity = null;
    /**
     * A list of backtrace step elements
     * @var array
     */
    protected $backtraces = array();
    /**
     * The events group identifier
     * @var Integer
     */
    protected $eventsGroupId = null;

    public function __construct()
    {

    }
    /**
     * @return the $type
     */
    public function getType ()
    {
        return $this->type;
    }

    /**
     * @return the $description
     */
    public function getDescription ()
    {
        return $this->description;
    }

    /**
     * @return the $superglobals
     */
    public function getSuperglobals ()
    {
        return $this->superglobals;
    }

    /**
     * @return the $debugUrl
     */
    public function getDebugUrl ()
    {
        return $this->debugUrl;
    }

    /**
     * @return the $severity
     */
    public function getSeverity ()
    {
        return $this->severity;
    }

    /**
     * @return the $backtraces
     */
    public function getBacktraces ()
    {
        return $this->backtraces;
    }

    /**
     * @param string $type
     */
    public function setType ($type)
    {
        $this->type = $type;
    }

    /**
     * @param string $description
     */
    public function setDescription ($description)
    {
        $this->description = $description;
    }

    /**
     * @param \ZendServerAPI\DataTypes\SuperGlobals $superglobals
     */
    public function setSuperglobals (\ZendServerAPI\DataTypes\SuperGlobals $superglobals)
    {
        $this->superglobals = $superglobals;
    }

    /**
     * @param string $debugUrl
     */
    public function setDebugUrl ($debugUrl)
    {
        $this->debugUrl = $debugUrl;
    }

    /**
     * @param string $severity
     */
    public function setSeverity ($severity)
    {
        $this->severity = $severity;
    }

    /**
     * @param multitype: $backtraces
     */
    public function addStep (\ZendServerAPI\DataTypes\Step $step)
    {
        $this->backtraces[] = $step;
    }
    /**
     * @return the $eventsGroupId
     */
    public function getEventsGroupId ()
    {
        return $this->eventsGroupId;
    }

    /**
     * @param number $eventsGroupId
     */
    public function setEventsGroupId ($eventsGroupId)
    {
        $this->eventsGroupId = $eventsGroupId;
    }

}
