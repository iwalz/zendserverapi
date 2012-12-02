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
 * CodetracingList model implementation.
 *
 * @license	    http://framework.zend.com/license/new-bsd New BSD License
 * @link		http://github.com/zendframework/zf2 for the canonical source repository
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @category	Zend
 * @package	    Zend_Service
 * @subpackage	ZendServerAPI
 */
class CodetracingList extends DataType implements \Countable, \IteratorAggregate
{
    /**
     * Internal codetracing storage
     * @var array
     */
    protected $codetracing = array();

    /**
     * Add codetracing to container
     *
     * @param  \ZendService\ZendServerAPI\DataTypes\CodeTrace $codetrace
     * @return void
     */
    public function addCodeTrace(\ZendService\ZendServerAPI\DataTypes\CodeTrace $codetrace)
    {
        $this->codetracing[] = $codetrace;
    }

    /**
     * Get codetrace array
     *
     * @return array
     */
    public function getCodetracing()
    {
        return $this->codetracing;
    }

    /**
     * Implementation for traversable
     *
     * @see IteratorAggregate::getIterator()
     * @return \ArrayIterator
     */
    public function getIterator ()
    {
        return new \ArrayIterator($this->codetracing);
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
