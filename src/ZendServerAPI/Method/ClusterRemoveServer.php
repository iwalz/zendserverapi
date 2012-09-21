<?php
namespace ZendServerAPI\Method;

class ClusterRemoveServer extends \ZendServerAPI\Method
{
    /**
     * ServerId to remove
     * @var int
     */
    private $server = null;
    /**
     * Force remove
     * @var boolean
     */
    private $force = null;

    /**
     * Constructor for ClusterRemoveServer method
     *
     * @param int $server ServerId to remove
     */
    public function __construct($server, $force = false)
    {
        $this->server = $server;
        $this->force = $force;
        parent::__construct();
    }

    /**
     * @see \ZendServerAPI\Method::configure()
     */
    public function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/clusterRemoveServer');
        $this->setParser(new \ZendServerAPI\Mapper\ServerInfo());
    }

    /**
     * Content for POST request
     *
     * @return string
     */
    public function getContent()
    {
        return ("serverId=".$this->server."&force=".($this->force === true ? 'TRUE' : 'FALSE'));
    }
}
