<?php
namespace ZendServerAPI\DataTypes;

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
     * @param  int                                       $serverId
     * @return \ZendServerAPI\DataTypes\ServerInfo|false
     */
    public function getServerStatusById($serverId)
    {
        foreach ($this->serverInfos as $serverInfo) {
            if($serverInfo->getId() === $serverId)

                return $serverInfo;
        }

        return false;
    }

    /**
     * Returns the ServerInfo by a given Zend Server Name
     *
     * @param  string                                    $serverName
     * @return \ZendServerAPI\DataTypes\ServerInfo|false
     */
    public function getServerStatusByName($serverName)
    {
        foreach ($this->serverInfos as $serverInfo) {
            if($serverInfo->getName() === $serverName)

                return $serverInfo;
        }

        return false;
    }

    /**
     * Returns the first ServerInfo object
     *
     * @return \ZendServerAPI\DataTypes\ServerInfo
     */
    public function getFirst()
    {
       if(count($this->serverInfos) === 0)
           throw new \Exception("No server in list");

       return $this->serverInfos[0];
    }
}
