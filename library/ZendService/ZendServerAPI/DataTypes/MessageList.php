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
 * MessageList model implementation.
 *
 * @license	    http://framework.zend.com/license/new-bsd New BSD License
 * @link		http://github.com/zendframework/zf2 for the canonical source repository
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @category	Zend
 * @package	    Zend_Service
 * @subpackage	ZendServerAPI
 */
class MessageList extends DataType
{
    /**
     * Info severity message
     * @var string
     */
    protected $info = null;
    /**
     * Warning severity message
     * @var string
     */
    protected $warning = null;
    /**
     * Error severity message
     * @var string
     */
    protected $error = null;

    /**
     * Constructor for MessageList DataType.
     * XML data can be provided here for parsing
     *
     * @param  string                                           $xmlData
     * @return \ZendService\ZendServerAPI\DataTypes\MessageList
     */
    public function __construct($xmlData = null)
    {
        if ($xmlData !== null) {
            $xml = simplexml_load_string($xmlData);

            $this->info = (string) $xml->info;
            $this->warning = (string) $xml->warning;
            $this->error = (string) $xml->error;
        }
    }

    /**
     * Get the info severity message
     *
     * @return string
     */
    public function getInfo ()
    {
        return $this->info;
    }

    /**
     * Get the warning severity message
     *
     * @return string
     */
    public function getWarning ()
    {
        return $this->warning;
    }

    /**
     * Get the error severity message
     *
     * @return string
     */
    public function getError ()
    {
        return $this->error;
    }

    /**
     * Set the severity info message
     *
     * @param  string $info
     * @return void
     */
    public function setInfo ($info)
    {
        $this->info = $info;
    }

    /**
     * Set the warning severity message
     *
     * @param  string $warning
     * @return void
     */
    public function setWarning ($warning)
    {
        $this->warning = $warning;
    }

    /**
     * Set the error severity message
     *
     * @param  string $error
     * @return void
     */
    public function setError ($error)
    {
        $this->error = $error;
    }

}
