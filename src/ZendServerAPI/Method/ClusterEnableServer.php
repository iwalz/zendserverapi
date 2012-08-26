<?php
namespace ZendServerAPI\Method;

class ClusterEnableServer extends \ZendServerAPI\Method
{
    function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/clusterEnableServer');
        $this->setParser(new \ZendServerAPI\Mapper\ServerInfo());
    }

}

?>