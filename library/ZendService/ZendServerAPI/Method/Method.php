<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright      Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @package        Zend_Service
 */

namespace ZendService\ZendServerAPI\Method;

use ZendService\ZendServerAPI\DataTypes\DataType;

/**
 * <b>Abstract class method implementations</b>
 *
 * <pre>All method implementations has to follow this
 * interface definition.</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
abstract class Method
{
    /**
     * Method for the current action
     * @var string GET|POST
     */
    protected $method = null;
    /**
     * Path to method on zendserver api
     * @var string
     */
    protected $functionPath = null;
    /**
     * Adapter for the result
     * @var \ZendService\ZendServerAPI\Adapter\Adapter
     */
    protected $parser = null;

    /**
     * Base constructor for the method implementations
     */
    public function __construct()
    {
        static::configure();
    }

    /**
     * Get the values for preparing the post
     *
     * @return array
     */
    public function getContentValues()
    {
        return array();
    }

    /**
     * Set method for the api call
     *
     * @param string GET|POST
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * Get method for the api call
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set the implementation for the result mapping
     *
     * @param  \ZendService\ZendServerAPI\Adapter\Adapter $parser <p>for result mapping</p>
     * @return void
     */
    public function setParser(\ZendService\ZendServerAPI\Adapter\Adapter $parser)
    {
        $this->parser = $parser;
    }

    /**
     * Get class for result mapping
     *
     * @return \ZendService\ZendServerAPI\Adapter\Adapter
     */
    public function getParser()
    {
        return $this->parser;
    }

    /**
     * Setter for the function path
     *
     * @param  string $functionPath <p>e.g. /ZendServerManager/Api/Foo</p>
     * @return void
     */
    public function setFunctionPath($functionPath)
    {
        $this->functionPath = $functionPath;
    }

    /**
     * Set the Guzzle Response
     *
     * @param \Guzzle\Http\Message\Response
     * @return void
     */
    public function setResponse(\Guzzle\Http\Message\Response $response)
    {
        $this->getParser()->setResponse($response);
    }

    /**
     * Getter for the path to server method
     *
     * @return string
     */
    public function getFunctionPath()
    {
        return $this->functionPath;
    }

    /**
     * Get result from parser
     *
     * @param string
     * @return DataTypes\DataType
     */
    public function parseResponse($xml = null)
    {
        return $this->getParser()->parse($xml);
    }

    /**
     * Get link for the method
     *
     * @return string
     */
    public function getLink()
    {
        return $this->getFunctionPath();
    }

    /**
     * Returns the default accept header
     *
     * @return string
     */
    public function getAcceptHeader()
    {
        return "application/vnd.zend.serverapi+xml;version=1.1";
    }

    /**
     * Returns the default content type
     *
     * @return string
     */
    public function getContentType()
    {
        return "application/x-www-form-urlencoded";
    }

    /**
     * Returns the default post files
     *
     * @return array
     */
    public function getPostFiles()
    {
        return array();
    }

    /**
     * Returns the parameter array for index $index
     *
     * @param string $index
     * @param array  $values
     */
    public function buildParameterArray($index, array $values)
    {
        $link = '';
        $parameterCount = count($values);

        foreach ($values as $key => $value) {
            $link .= urlencode($index."[".$key."]")."=".$value;
            if($key+1 < $parameterCount)
                $link .= "&";
        }

        return $link;
    }

    /**
     * Configures all needed information for the method implementation
     *
     * @return void
     */
    abstract public function configure();
}
