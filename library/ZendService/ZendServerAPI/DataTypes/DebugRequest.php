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
 * DebugRequest model implementation.
 *
 * @license	http://framework.zend.com/license/new-bsd New BSD License
 * @link		http://github.com/zendframework/zf2 for the canonical source repository
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @category	Zend
 * @package	Zend_Service
 * @subpackage	ZendServerAPI
 */
class DebugRequest extends DataType
{
    /**
     * 1 if success
     * @var int
     */
    protected $success = null;
    /**
     * Return message
     * @var string
     */
    protected $message = null;

    /**
     * Get if debugrequest was successful
     *
     * @return int
     */
    public function getSuccess ()
    {
        return $this->success;
    }

    /**
     * Get the returned message
     *
     * @return string
     */
    public function getMessage ()
    {
        return $this->message;
    }

    /**
     * Set the success property
     *
     * @param  int  $success
     * @return void
     */
    public function setSuccess ($success)
    {
        $this->success = (int) $success;
    }

    /**
     * Set the message
     *
     * @param  string $message
     * @return void
     */
    public function setMessage ($message)
    {
        $this->message = $message;
    }

}
