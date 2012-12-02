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
 * RouteDetails model implementation.
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class RouteDetails extends DataType implements \Countable, \IteratorAggregate
{
    /**
     * Internal route detail array
     * @var array
     */
    protected $routeDetails = array();

    /**
     * Add a route detail to the list
     *
     * @param  \ZendService\ZendServerAPI\DataTypes\RouteDetail $routeDetail
     * @return void
     */
    public function addRouteDetails(\ZendService\ZendServerAPI\DataTypes\RouteDetail $routeDetail)
    {
        $this->routeDetails[] = $routeDetail;
    }

    /**
     * Get the internal route detail list array
     *
     * @return array
     */
    public function getRouteDetails()
    {
        return $this->routeDetails;
    }

    /**
     * Implementation for traversable
     *
     * @see IteratorAggregate::getIterator()
     * @return \ArrayIterator
     */
    public function getIterator ()
    {
        return new \ArrayIterator($this->routeDetails);
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
