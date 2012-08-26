<?php
namespace ZendServerAPI\Method;

class ClusterReconfigureServer extends \ZendServerAPI\Method
{
    function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/clusterReconfigureServer');
        $this->setParser(new \ZendServerAPI\Mapper\ServersList());
    }

}

