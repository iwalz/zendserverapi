<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link 		http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright 	Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license 	http://framework.zend.com/license/new-bsd New BSD License
 * @package 	Zend_Service
 */

namespace ZendService\ZendServerAPI\Adapter;

/**
 * Base adapter implementation
 *
 * @license	    http://framework.zend.com/license/new-bsd New BSD License
 * @link		http://github.com/zendframework/zf2 for the canonical source repository
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @category	Zend
 * @package	    Zend_Service
 * @subpackage	ZendServerAPI
 */
abstract class Adapter
{
    /**
     * The Guzzle response object
     * @var \Guzzle\Http\Message\Response
     */
    protected $response = null;

    /**
     * Parse the xml response in object mappings
     *
     * @return \ZendService\ZendServerAPI\DataTypes\DataType
     */
    abstract public function parse();

    /**
     * Set the Guzzle Response
     *
     * @param \Guzzle\Http\Message\Response
     * @return void
     */
    public function setResponse(\Guzzle\Http\Message\Response $response)
    {
        $this->response = $response;
    }

    /**
     * Get the Guzzle Response
     *
     * @return \Guzzle\Http\Message\Response
     */
    public function getResponse()
    {
        return $this->response ;
    }
}
