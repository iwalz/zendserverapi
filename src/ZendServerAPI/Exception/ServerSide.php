<?php

namespace ZendServerAPI\Exception;

class ServerSide extends \Exception 
{
    /**
     * Constructor for serverside exception
     *
     * @param string error message
     * @param int error code
     */
	public function __construct($error, $code = null)
	{
		$xml = simplexml_load_string($error);
		$errorCode = (string)$xml->errorData->errorCode;
		$errorMessage = (string)$xml->errorData->errorMessage;
	
		if($code === null)
		    $code = 500;
		parent::__construct($errorCode . ': ' . $errorMessage, $code);
	}
}

?>