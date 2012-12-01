<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link 		http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright 	Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license 	http://framework.zend.com/license/new-bsd New BSD License
 * @package 	Zend_Service
 */

namespace ZendService\ZendServerAPI\Exception;

/**
 * Exception to handle errors, that are flagged by the
 * Zend Server as "Client Side"
 *
 * @license	http://framework.zend.com/license/new-bsd New BSD License
 * @link		http://github.com/zendframework/zf2 for the canonical source repository
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @category	Zend
 * @package	Zend_Service
 * @subpackage	ZendServerAPI
 */
class ClientSide extends \Exception
{
    /**
     * Constructor for clientside exception
     *
     * @param string error message
     * @param int error code
     */
    public function __construct($error, $code = null)
    {
        $xml = @simplexml_load_string($error);

        if($code === null)
            $code = 400;

        if (!$xml || !isset($xml->errorData->errorCode) || !isset($xml->errorData->errorMessage)) {
            parent::__construct($error, $code);
        } else {
            $errorCode = (string) $xml->errorData->errorCode;
            $errorMessage = (string) $xml->errorData->errorMessage;

            parent::__construct($errorCode . ': ' . $errorMessage, $code);
        }
    }
}
