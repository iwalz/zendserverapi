<?php
namespace ZendServerAPI\DataTypes;

class ServersList
{
    private $serverInfos = array();
    
    public function getServerInfos()
    {
        return $this->serverInfos;
    }
    
    public function setServerInfos(array $serverInfos)
    {
        $this->serverInfos = $serverInfos;
    }
    
    public function addServerInfo(ServerInfo $serverInfo)
    {
        $this->serverInfos[] = $serverInfo;
    }
}

?>