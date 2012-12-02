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
 * Event model implementation.
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class Event extends DataType
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
     * @var \ZendService\ZendServerAPI\DataTypes\SuperGlobals
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

    /**
     * Get the type
     *
     * @return string
     */
    public function getType ()
    {
        return $this->type;
    }

    /**
     * Get the free form text field with
     * details about the issue
     *
     * @return string
     */
    public function getDescription ()
    {
        return $this->description;
    }

    /**
     * Get the superglobals
     *
     * @return \ZendService\ZendServerAPI\DataTypes\SuperGlobals
     */
    public function getSuperglobals ()
    {
        return $this->superglobals;
    }

    /**
     * Get the URL for debugging event
     *
     * @return string
     */
    public function getDebugUrl ()
    {
        return $this->debugUrl;
    }

    /**
     * Get the severity
     *
     * @return string
     */
    public function getSeverity ()
    {
        return $this->severity;
    }

    /**
     * Get an array of \ZendService\ZendServerAPI\DataTypes\Step
     * objects
     *
     * @return array
     */
    public function getBacktraces ()
    {
        return $this->backtraces;
    }

    /**
     * Set the issue type name
     *
     * @param string
     * @return void
     */
    public function setType ($type)
    {
        $this->type = $type;
    }

    /**
     * Set the description
     *
     * @param string
     * @return void
     */
    public function setDescription ($description)
    {
        $this->description = $description;
    }

    /**
     * Set the superglobals
     *
     * @param  \ZendService\ZendServerAPI\DataTypes\SuperGlobals $superglobals
     * @return void
     */
    public function setSuperglobals (\ZendService\ZendServerAPI\DataTypes\SuperGlobals $superglobals)
    {
        $this->superglobals = $superglobals;
    }

    /**
     * Set the URL of the debug event
     *
     * @param  string $debugUrl
     * @return void
     */
    public function setDebugUrl ($debugUrl)
    {
        $this->debugUrl = $debugUrl;
    }

    /**
     * Set the severity
     *
     * @param  string $severity
     * @return void
     */
    public function setSeverity ($severity)
    {
        $this->severity = $severity;
    }

    /**
     * Add a step to the $backtraces array
     *
     * @param  \ZendService\ZendServerAPI\DataTypes\Step $step
     * @return void
     */
    public function addStep (\ZendService\ZendServerAPI\DataTypes\Step $step)
    {
        $this->backtraces[] = $step;
    }

    /**
     * Get the events group identifier
     *
     * @return int
     */
    public function getEventsGroupId ()
    {
        return $this->eventsGroupId;
    }

    /**
     * Set the events group identifier
     *
     * @param  int  $eventsGroupId
     * @return void
     */
    public function setEventsGroupId ($eventsGroupId)
    {
        $this->eventsGroupId = (int) $eventsGroupId;
    }

}
