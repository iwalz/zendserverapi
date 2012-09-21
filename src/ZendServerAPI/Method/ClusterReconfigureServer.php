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
     * Restart server after action
     * @var
     */
    private $doRestart = null;

    /**
     * Constructor for ClusterReconfigureServer method
     *
     * @param int $server ServerId to reconfigure
     * @param boolean restart server after action
     */
    public function __construct($server, $doRestart = false)
    {
        $this->server = $server;
        $this->doRestart = $doRestart;
        parent::__construct();
    }

    /**
     * Content for POST request
     *
     * @return string
     */
    public function getContent()
    {
        return ("serverId=".$this->server."&doRestart=".($this->doRestart === true ? 'TRUE' : 'FALSE'));
    }

    /**
     * @see \ZendServerAPI\Method::configure()
     */
    public function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/clusterReconfigureServer');
        $this->setParser(new \ZendServerAPI\Mapper\ServerInfo());
    }

}
