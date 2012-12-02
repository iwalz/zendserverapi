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
 * RequestSummary model implementation.
 *
 * @license	    http://framework.zend.com/license/new-bsd New BSD License
 * @link		http://github.com/zendframework/zf2 for the canonical source repository
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @category	Zend
 * @package	    Zend_Service
 * @subpackage	ZendServerAPI
 */
class RequestSummary extends DataType implements \IteratorAggregate, \Countable
{
    /**
     * Number of event occurance
     * @var int
     */
    protected $eventsCount = null;
    /**
     * CodeTrace identifier
     * @var string
     */
    protected $codeTracing = null;
    /**
     * Internal event storage
     * @var array
     */
    protected $events = array();

    /**
     * Get the number of event occurance
     *
     * @return int
     */
    public function getEventsCount ()
    {
        return $this->eventsCount;
    }

    /**
     * Get the CodeTrace identifier
     *
     * @return string
     */
    public function getCodeTracing ()
    {
        return $this->codeTracing;
    }

    /**
     * Get the internal events
     *
     * @return array
     */
    public function getEvents ()
    {
        return $this->events;
    }

    /**
     * Set the number of event occurance
     *
     * @param  int  $eventsCount
     * @return void
     */
    public function setEventsCount ($eventsCount)
    {
        $this->eventsCount = (int) $eventsCount;
    }

    /**
     * Set the CodeTrace identifier
     *
     * @param  string $codeTracing
     * @return void
     */
    public function setCodeTracing ($codeTracing)
    {
        $this->codeTracing = $codeTracing;
    }

    /**
     * Add event to the internal list storage
     *
     * @param  \ZendService\ZendServerAPI\DataTypes\Event $event
     * @return void
     */
    public function addEvents (\ZendService\ZendServerAPI\DataTypes\Event $event)
    {
        $this->events[] = $event;
    }

    /**
     * Implementation for traversable
     *
     * @see IteratorAggregate::getIterator()
     * @return \ArrayIterator
     */
    public function getIterator ()
    {
        return new \ArrayIterator($this->events);
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
