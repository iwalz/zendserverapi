<?php
namespace ZendServerAPI\Method;

class ClusterReconfigureServer extends \ZendServerAPI\Method
{
    function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/clusterReconfigureServer');
    }

    function parseResponse ($xml)
    {
        
    }
}

