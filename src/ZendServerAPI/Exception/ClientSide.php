<?php

namespace ZendServerAPI\Exception;

class ClientSide extends \Exception 
{
    /**
     * Constructor for clientside exception
     * 
     * @param string $error
     */
	public function __construct($error)
	{
		$xml = simplexml_load_string($error);
		$errorCode = (string)$xml->errorData->errorCode;
		$errorMessage = (string)$xml->errorData->errorMessage;
		
		parent::__construct($errorCode . ': ' . $errorMessage, 400);
	}
}

?>