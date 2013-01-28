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
use ZendService\ZendServerAPI\DataTypes\Rule;

/**
 * Rules model implementation.
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class Rules extends DataType implements \Countable, \IteratorAggregate
{
    /**
     * Internal container for rules storage
     * @var array
     */
    private $rules = array();

    /**
     * Get the internal rules container
     *
     * @return array
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * Add rule to container
     *
     * @param  Rule $rule
     * @return void
     */
    public function addRule(Rule $rule)
    {
        $this->rules[] = $rule;
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
