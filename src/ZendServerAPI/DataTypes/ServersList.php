<?php
namespace ZendServerAPI\DataTypes;

use ZendServerAPI\Exception\ClientSide;

class ServersList
{
    /**
     * Internal container for ServerInfo storage
     * @var array
     */
    private $serverInfos = array();
    
    /**
     * Get the internal ServerInfo container
     * 
     * @return array
     */
    public function getServerInfos()
    {
        return $this->serverInfos;
    }
    
    /**
     * Set ServerInfo container
     * 
     * @param array $serverInfos
     */
    public function setServerInfos(array $serverInfos)
    {
        $this->serverInfos = $serverInfos;
    }
    
    /**
     * Add ServerInfo to container
     * 
     * @param ServerInfo $serverInfo
     */
    public function addServerInfo(ServerInfo $serverInfo)
    {
        $this->serverInfos[] = $serverInfo;
    }
    
    /**
     * Returns the ServerInfo by a given Zend Server ID
     * 
     * @param int $serverId
     * @throws \InvalidArgumentException
     * @return \ZendServerAPI\DataTypes\ServerInfo
     */
    public function getServerStatusById($serverId)
    {
        foreach($this->serverInfos as $serverInfo)
        {
            if($serverInfo->getId() === $serverId)
                return $serverInfo;
        }
        throw new \InvalidArgumentException("Zend Server not found by ID: " . $serverId);
    }
    
    /**
     * Returns the ServerInfo by a given Zend Server Name
     *
     * @param string $serverName
     * @throws \InvalidArgumentException
     * @return \ZendServerAPI\DataTypes\ServerInfo
     */
    public function getServerStatusByName($serverName)
    {
        foreach($this->serverInfos as $serverInfo)
        {
            if($serverInfo->getName() === $serverName)
                return $serverInfo;
        }
        throw new \InvalidArgumentException("Zend Server not found by Name: " . $serverName);
    }
    
    /**
     * Returns the first ServerInfo object
     * 
     * @throws \ZendServerAPI\Exception\ClientSide
     * @return \ZendServerAPI\DataTypes\ServerInfo
     */
    public function getFirst()
    {
       if(count($this->serverInfos) === 0)
           throw new ClientSide("No server in list");

       return $this->serverInfos[0];
    }
}

?>