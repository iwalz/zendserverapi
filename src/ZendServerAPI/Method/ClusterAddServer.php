<?php
namespace ZendServerAPI\Method;

class ClusterAddServer extends \ZendServerAPI\Method
{
    function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/clusterAddServer');
        $this->setParser(new \ZendServerAPI\Mapper\ServerInfo());
    }

}

?>