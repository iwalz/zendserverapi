<?php
namespace ZendServerAPI\Method;
use ZendServerAPI\DataTypes\ServersList,
    ZendServerAPI\DataTypes\ServerInfo,
    ZendServerAPI\DataTypes\MessageList;

class ClusterGetServerStatus  extends \ZendServerAPI\Method
{
    /**
     * Servers to get the status for
     * @var array
     */
    private $servers = null;
    
    /**
     * Constructor for ClusterGetServerStatus
     * 
     * @param array $servers Default returns all servers of the cluster
     */
    public function __construct(array $servers = array())
    {
        $this->servers = $servers;
        parent::__construct();
    }
    
    /**
     * @see \ZendServerAPI\Method::configure()
     */
    public function configure()
    {
        $this->setMethod('GET');
        $this->setFunctionPath('/ZendServerManager/Api/clusterGetServerStatus');
        $this->setParser(new \ZendServerAPI\Mapper\ServersList());
    }

    /**
     * Set the list of server ids
     * 
     * @param array $servers
     */
    public function setParameters(array $servers)
    {
        $this->servers = $servers;
    }
    
    /**
     * @see \ZendServerAPI\Method::getLink()
     */
    public function getLink()
    {
        $link = $this->getFunctionPath();
        $parameterCount = count($this->servers); 
        
        if($parameterCount > 0)
            $link .= "?";
        
        foreach($this->servers as $index => $server)
        {
            $link .= urlencode("servers[".$index."]")."=".$server;
            if($index+1 < $parameterCount)
                $link .= "&";
        }
        
        return $link;
    }
    
}

?>