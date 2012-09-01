<?php
namespace ZendServerAPI\Method;

class ClusterAddServer extends \ZendServerAPI\Method
{
    private $serverName = null;
    private $serverUrl = null;
    private $guiPassword = null;
    
    public function __construct($serverName, $serverUrl, $guiPassword)
    {
        $this->serverName = $serverName;
        $this->serverUrl = $serverUrl;
        $this->guiPassword = $guiPassword;
        parent::__construct();
    }
    
    public function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/clusterAddServer');
        $this->setParser(new \ZendServerAPI\Mapper\ServerInfo());
    }

    public function getContent()
    {
        return
            "serverName=".$this->serverName."&".
            "serverUrl=".$this->serverUrl."&".
            "guiPassword=".$this->guiPassword;
    }
}

?>