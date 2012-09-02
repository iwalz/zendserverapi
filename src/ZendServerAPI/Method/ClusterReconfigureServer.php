<?php
namespace ZendServerAPI\Method;

class ClusterReconfigureServer extends \ZendServerAPI\Method
{
    private $parameter = null;
    
    public function __construct($server)
    {
        $this->setParameter($server);
        parent::__construct();
    }
    
    private function setParameter($parameter)
    {
        $this->parameter = $parameter;
    }
    
    public function getContent()
    {
        return ("serverId=".$this->parameter);
    }
    
    function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/clusterReconfigureServer');
        $this->setParser(new \ZendServerAPI\Mapper\ServerInfo());
    }

}

