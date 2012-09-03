<?php
namespace ZendServerAPI\Method;

class ClusterEnableServer extends \ZendServerAPI\Method
{
    /**
     * Id of server to enable
     * @var int
     */
    private $serverId = null;
    
    /**
     * Constructor of ClusterEnableServer method
     * 
     * @param int $serverId
     */
    public function __construct($serverId)
    {
        $this->serverId = $serverId;
        parent::__construct();
    }
    
    /**
     * @see \ZendServerAPI\Method::configure()
     */
    function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/clusterEnableServer');
        $this->setParser(new \ZendServerAPI\Mapper\ServerInfo());
    }

    /**
     * Content for POST request
     * 
     * @return string
     */
    public function getContent()
    {
        return ("serverId=".$this->serverId);
    }
}

?>