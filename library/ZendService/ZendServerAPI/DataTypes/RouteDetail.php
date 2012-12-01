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
 * RouteDetail model implementation.
 *
 * @license	http://framework.zend.com/license/new-bsd New BSD License
 * @link		http://github.com/zendframework/zf2 for the canonical source repository
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @category	Zend
 * @package	Zend_Service
 * @subpackage	ZendServerAPI
 */
class RouteDetail extends DataType
{
    /**
     * Route detail piece's key name
     * @var string
     */
    protected $key = null;
    /**
     * Route detail piece's value
     * @var string
     */
    protected $value = null;

    /**
     * Get the route detail piece's key name
     *
     * @return string
     */
    public function getKey ()
    {
        return $this->key;
    }

    /**
     * Get the route detail piece's value
     *
     * @return string
     */
    public function getValue ()
    {
        return $this->value;
    }

    /**
     * Set the route detail piece's key name
     *
     * @param  string $key
     * @return void
     */
    public function setKey ($key)
    {
        $this->key = $key;
    }

    /**
     * Set the route detail piece's value
     *
     * @param  string $value
     * @return void
     */
    public function setValue ($value)
    {
        $this->value = $value;
    }

}
