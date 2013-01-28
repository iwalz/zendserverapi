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

use ArrayIterator;
use Countable;
use IteratorAggregate;

/**
 * Notifications model implementation.
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class Notifications extends DataType implements Countable, IteratorAggregate
{
    /**
     * Internal container for notification storage
     * @var array
     */
    private $notifications = array();

    /**
     * Get the internal notification container
     *
     * @return array
     */
    public function getNotifications()
    {
        return $this->notifications;
    }

    /**
     * Add notification to container
     *
     * @param  Notification $notification
     * @return void
     */
    public function addNotification(Notification $notification)
    {
        $this->notifications[] = $notification;
    }

    /**
     * Implementation for traversable
     *
     * @see IteratorAggregate::getIterator()
     * @return \ArrayIterator
     */
    public function getIterator ()
    {
        return new ArrayIterator($this->serverInfos);
    }

    /**
     * Implementation for countable
     *
     * @see Countable::count()
     * @return void
     */
    public function count ()
    {
        return count($this->getIterator());
    }
}
