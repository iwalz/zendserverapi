<?php
namespace ZendServerAPI\Method;

class RestartPHP extends \ZendServerAPI\Method
{
    function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/restartPhp');
    }

    function parseResponse ($xml)
    {
        
    }
}

?>