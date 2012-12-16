<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright      Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @package        Zend_Service
 */

namespace ZendService\ZendServerAPI\Adapter;

/**
 * Base adapter implementation
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
abstract class Adapter
{
    /**
     * The Zend HTTP response object
     * @var \Zend\Http\Response
     */
    protected $response = null;

    /**
     * Parse the xml response in object mappings
     *
     * @return \ZendService\ZendServerAPI\DataTypes\DataType
     */
    abstract public function parse();

    /**
     * Set the Zend Http Response
     *
     * @param \Zend\Http\Response
     * @return void
     */
    public function setResponse(\Zend\Http\Response $response)
    {
        $this->response = $response;
    }

    /**
     * Get the Zend HTTP Response
     *
     * @return \Zend\Http\Response
     */
    public function getResponse()
    {
        return $this->response;
    }
}
