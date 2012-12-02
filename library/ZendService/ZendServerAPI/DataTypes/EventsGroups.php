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
 * EventsGroupDetails model implementation.
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class EventsGroups extends DataType implements \Countable, \IteratorAggregate
{
    /**
     * Internal event group array
     * @var array
     */
    protected $eventGroups = array();

    /**
     * Add an event group to the list
     *
     * @param  \ZendService\ZendServerAPI\DataTypes\EventsGroup $eventGroup
     * @return void
     */
    public function addEventGroup(\ZendService\ZendServerAPI\DataTypes\EventsGroup $eventGroup)
    {
        $this->eventGroups[] = $eventGroup;
    }

    /**
     * Get the internal event group array
     *
     * @return array
     */
    public function getEventGroups()
    {
        return $this->eventGroups;
    }

    /**
     * Implementation for traversable
     *
     * @see IteratorAggregate::getIterator()
     * @return \ArrayIterator
     */
    public function getIterator ()
    {
        return new \ArrayIterator($this->eventGroups);
    }

    /**
     * Implementation for countable
     *
     * @see Countable::count()
     * @return int
     */
    public function count ()
    {
        return count($this->getIterator());
    }
}
