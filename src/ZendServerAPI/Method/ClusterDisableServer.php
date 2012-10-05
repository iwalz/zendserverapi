<?php
namespace ZendServerAPI\Method;

class ClusterDisableServer extends \ZendServerAPI\Method
{
    /**
     * Parameter for ClusterDisableServer method
     * @var int
     */
    private $serverId = null;

    /**
     * Constructor for ClusterDisableServer method
     *
     * @param int $server Id of the server to disable
     */
    public function __construct($serverId)
    {
        $this->serverId = $serverId;
        parent::__construct();
    }

    /**
     * @see \ZendServerAPI\Method::configure()
     */
    public function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/clusterDisableServer');
        $this->setParser(new \ZendServerAPI\Adapter\ServerInfo());
    }

    /**
     * Content for POST request
     * @return string
     */
    public function getContent()
    {
        return ("serverId=".$this->serverId);
    }
}
