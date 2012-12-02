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
 * Step model implementation.
 *
 * @license	    http://framework.zend.com/license/new-bsd New BSD License
 * @link		http://github.com/zendframework/zf2 for the canonical source repository
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @category	Zend
 * @package	    Zend_Service
 * @subpackage	ZendServerAPI
 */
class Step extends DataType
{
    /**
     * Sequential numbering of the backtrace steps
     * @var int
     */
    protected $number = null;
    /**
     * Object identifier
     * @var string
     */
    protected $object = null;
    /**
     * Object class identifer
     * @var string
     */
    protected $class = null;
    /**
     * Function or method name
     * @var string
     */
    protected $function = null;
    /**
     * Filepath
     * @var string
     */
    protected $file = null;
    /**
     * Line number in the file
     * @var int
     */
    protected $line = null;

    /**
     * Get the sequential numbering of the backtrace steps
     *
     * @return int
     */
    public function getNumber ()
    {
        return $this->number;
    }

    /**
     * Get the object identifier
     *
     * @return string
     */
    public function getObject ()
    {
        return $this->object;
    }

    /**
     * Object class identifer
     *
     * @return string
     */
    public function getClass ()
    {
        return $this->class;
    }

    /**
     * Get the function or method name
     *
     * @return string
     */
    public function getFunction ()
    {
        return $this->function;
    }

    /**
     * Get the Filepath
     *
     * @return string
     */
    public function getFile ()
    {
        return $this->file;
    }

    /**
     * Get the line number in the file
     *
     * @return int
     */
    public function getLine ()
    {
        return $this->line;
    }

    /**
     * Set the sequential numbering of the backtrace steps
     *
     * @param  int  $number
     * @return void
     */
    public function setNumber ($number)
    {
        $this->number = (int) $number;
    }

    /**
     * Set the object identifier
     *
     * @param  string $object
     * @return void
     */
    public function setObject ($object)
    {
        $this->object = $object;
    }

    /**
     * Set the object class identifer
     *
     * @param  string $class
     * @return void
     */
    public function setClass ($class)
    {
        $this->class = $class;
    }

    /**
     * Set the function or method name
     *
     * @param  string $function
     * @return void
     */
    public function setFunction ($function)
    {
        $this->function = $function;
    }

    /**
     * Set the Filepath
     *
     * @param  string $file
     * @return void
     */
    public function setFile ($file)
    {
        $this->file = $file;
    }

    /**
     * Set the line number in the file
     *
     * @param  int  $line
     * @return void
     */
    public function setLine ($line)
    {
        $this->line = (int) $line;
    }

}
