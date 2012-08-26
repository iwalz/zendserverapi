<?php
namespace ZendServerAPI\Method;

class ClusterDisableServer extends \ZendServerAPI\Method
{
    function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/clusterRemoveServer');
    }

    function parseResponse ($xml)
    {
        
    }
}

?>