<?php
namespace ZendServerAPI\Method;
use ZendServerAPI\DataTypes\ServersList,
    ZendServerAPI\DataTypes\ServerInfo,
    ZendServerAPI\DataTypes\MessageList;

class ClusterGetServerStatus  extends \ZendServerAPI\Method
{
    private $paramters = null;
    
    public function __construct(array $servers = array())
    {
        $this->setParameters($servers);
        parent::__construct();
    }
    
    public function configure()
    {
        $this->setMethod('GET');
        $this->setFunctionPath('/ZendServerManager/Api/clusterGetServerStatus');
        $this->setParser(new \ZendServerAPI\Mapper\ServersList());
    }
    
    public function setParameters(array $servers)
    {
        if(0 === count($servers))
            throw new \Exception("No given arguments");
        else
            $this->parameters = $servers;
    }
    
}

?>