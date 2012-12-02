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
 * IssueDetails model implementation.
 *
 * @license	    http://framework.zend.com/license/new-bsd New BSD License
 * @link		http://github.com/zendframework/zf2 for the canonical source repository
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @category	Zend
 * @package	    Zend_Service
 * @subpackage	ZendServerAPI
 */
class IssueDetails extends DataType
{
    /**
     * The issue
     * @var \ZendService\ZendServerAPI\DataTypes\Issue
     */
    protected $issue = null;
    /**
     * The event groups
     * @var array
     */
    protected $eventsGroups = array();

    /**
     * Get the issue
     *
     * @return \ZendService\ZendServerAPI\DataTypes\Issue
     */
    public function getIssue ()
    {
        return $this->issue;
    }

    /**
     * Get the event groups
     *
     * @return array
     */
    public function getEventsGroups ()
    {
        return $this->eventsGroups;
    }

    /**
     * Set the issue
     *
     * @param  \ZendService\ZendServerAPI\DataTypes\Issue $issue
     * @return void
     */
    public function setIssue (\ZendService\ZendServerAPI\DataTypes\Issue $issue)
    {
        $this->issue = $issue;
    }

    /**
     * Add an event group
     *
     * @param  \ZendService\ZendServerAPI\DataTypes\EventsGroup $eventsGroup
     * @return void
     */
    public function addEventsGroup (\ZendService\ZendServerAPI\DataTypes\EventsGroup $eventsGroup)
    {
        $this->eventsGroups[] = $eventsGroup;
    }

}
