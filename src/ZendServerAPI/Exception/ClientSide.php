<?php

namespace ZendServerAPI\Exception;

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
        $xml = simplexml_load_string($error);
        $errorCode = (string) $xml->errorData->errorCode;
        $errorMessage = (string) $xml->errorData->errorMessage;

        if($code === null)
            $code = 400;
        parent::__construct($errorCode . ': ' . $errorMessage, $code);
    }
}
