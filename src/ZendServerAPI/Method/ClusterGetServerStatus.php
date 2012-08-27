<?php
namespace ZendServerAPI\Method;
use ZendServerAPI\DataTypes\ServersList,
    ZendServerAPI\DataTypes\ServerInfo,
    ZendServerAPI\DataTypes\MessageList;

class ClusterGetServerStatus  extends \ZendServerAPI\Method
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function configure()
    {
        $this->setMethod('GET');
        $this->setFunctionPath('/ZendServerManager/Api/clusterGetServerStatus');
        $this->setParser(new \ZendServerAPI\Mapper\ServersList());
    }
    
}

?>