<?php
namespace ZendServerAPI\Method;

class ClusterAddServer extends \ZendServerAPI\Method
{
    /**
     * Name of server to add
     * @var string
     */
    private $serverName = null;
    /**
     * Url to server gui e.g. http://192.168.1.5:10081/ZendServer
     * @var string
     */
    private $serverUrl = null;
    /**
     * Password for zend server gui
     * @var string
     */
    private $guiPassword = null;
    
    /**
     * Constructor of method ClusterAddServer
     * 
     * @param string $serverName Name of server to add
     * @param string $serverUrl Url of server e.g. http://192.168.1.5:10081/ZendServer
     * @param string $guiPassword Password for gui
     */
    public function __construct($serverName, $serverUrl, $guiPassword)
    {
        $this->serverName = $serverName;
        $this->serverUrl = $serverUrl;
        $this->guiPassword = $guiPassword;
        parent::__construct();
    }
    
    /**
     * @see \ZendServerAPI\Method::configure()
     */
    public function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/clusterAddServer');
        $this->setParser(new \ZendServerAPI\Mapper\ServerInfo());
    }

    /**
     * Get content for POST body
     * 
     * @return string
     */
    public function getContent()
    {
        return
            "serverName=".$this->serverName."&".
            "serverUrl=".$this->serverUrl."&".
            "guiPassword=".$this->guiPassword;
    }
}

?>