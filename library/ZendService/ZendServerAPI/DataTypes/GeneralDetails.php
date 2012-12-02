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
 * GeneralDetails model implementation.
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class GeneralDetails extends DataType
{
    /**
     * Issue's creating URL string
     * @var string
     */
    protected $url = null;
    /**
     * Path to the file where the issue manifested
     * @var string
     */
    protected $sourceFile = null;
    /**
     * Line number where the issue manifests
     * within the SourceFile
     * @var int
     */
    protected $sourceLine = null;
    /**
     * Name of the function that caused the issue to manifest
     * @var string
     */
    protected $function = null;
    /**
     * A unique identifier that groups all
     * events under this issue
     * @var int
     */
    protected $aggregationHint = null;
    /**
     * The error string generated for the events
     * @var string
     */
    protected $errorString = null;
    /**
     * PHP Error type created for the event
     * @var string
     */
    protected $errorType = null;

    /**
     * Get the issue's creating URL string
     *
     * @return string
     */
    public function getUrl ()
    {
        return $this->url;
    }

    /**
     * Get the path to the file where the issue manifested
     *
     * @return string
     */
    public function getSourceFile ()
    {
        return $this->sourceFile;
    }

    /**
     * Line number where the issue manifests within the SourceFile
     *
     * @return int
     */
    public function getSourceLine ()
    {
        return $this->sourceLine;
    }

    /**
     * Get the name of the function that caused the issue to manifest
     *
     * @return string
     */
    public function getFunction ()
    {
        return $this->function;
    }

    /**
     * Get the unique identifier that groups all events under this issue
     *
     * @return int
     */
    public function getAggregationHint ()
    {
        return $this->aggregationHint;
    }

    /**
     * Get the error string generated for the events
     *
     * @return string
     */
    public function getErrorString ()
    {
        return $this->errorString;
    }

    /**
     * Get the PHP Error type created for the event
     *
     * @return string
     */
    public function getErrorType ()
    {
        return $this->errorType;
    }

    /**
     * Set the issue's creating URL string
     *
     * @param string $url
     */
    public function setUrl ($url)
    {
        $this->url = $url;
    }

    /**
     * Set the path to the file where the issue manifested
     *
     * @param  string $sourceFile
     * @return void
     */
    public function setSourceFile ($sourceFile)
    {
        $this->sourceFile = $sourceFile;
    }

    /**
     * Set the line number where the issue manifests within
     * the SourceFile
     *
     * @param  int  $sourceLine
     * @return void
     */
    public function setSourceLine ($sourceLine)
    {
        $this->sourceLine = (int) $sourceLine;
    }

    /**
     * Set the name of the function that caused the issue to manifest
     *
     * @param  string $function
     * @return void
     */
    public function setFunction ($function)
    {
        $this->function = $function;
    }

    /**
     * Set the unique identifier that groups all events under this issue
     *
     * @param  string $aggregationHint
     * @return void
     */
    public function setAggregationHint ($aggregationHint)
    {
        $this->aggregationHint = $aggregationHint;
    }

    /**
     * Set the error string generated for the events
     *
     * @param  string $errorString
     * @return void
     */
    public function setErrorString ($errorString)
    {
        $this->errorString = $errorString;
    }

    /**
     * Set the PHP Error type created for the event
     *
     * @param  string $errorType
     * @return void
     */
    public function setErrorType ($errorType)
    {
        $this->errorType = $errorType;
    }

}
