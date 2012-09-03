<?php
namespace ZendServerAPI\Method;

class ClusterReconfigureServer extends \ZendServerAPI\Method
{
    /**
     * ServerId for reconfiguration
     * @var int
     */
    private $server = null;
    
    /**
     * Constructor for ClusterReconfigureServer method
     * 
     * @param int $server ServerId to reconfigure
     */
    public function __construct($server)
    {
        $this->server = $server;
        parent::__construct();
    }
    
    /**
     * Content for POST request
     * 
     * @return string
     */
    public function getContent()
    {
        return ("serverId=".$this->server);
    }
    
    /**
     * @see \ZendServerAPI\Method::configure()
     */
    function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/clusterReconfigureServer');
        $this->setParser(new \ZendServerAPI\Mapper\ServerInfo());
    }

}

