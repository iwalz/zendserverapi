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

/**
 * Jobs model implementation.
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class Jobs extends DataType implements \Countable, \IteratorAggregate
{
    protected $jobs = array();

    /**
     * Implementation for traversable
     *
     * @see IteratorAggregate::getIterator()
     * @return \ArrayIterator
     */
    public function getIterator ()
    {
        return new ArrayIterator($this->applicationInfos);
    }

    /**
     * Implementation for countable
     *
     * @see Countable::count()
     * @return int
     */
    public function count()
    {
        return count($this->getIterator());
    }

    /**
     * Add job object to container
     *
     * @param  \ZendService\ZendServerAPI\DataTypes\Job $job
     * @return void
     */
    public function addJob(Job $job)
    {
        $this->jobs[] = $job;
    }

    /**
     * Get internal storage
     *
     * @return array
     */
    public function getJobs()
    {
        return $this->jobs;
    }
}
