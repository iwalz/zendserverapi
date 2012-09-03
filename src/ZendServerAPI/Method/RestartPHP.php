<?php
namespace ZendServerAPI\Method;

class RestartPHP extends \ZendServerAPI\Method
{
    /**
     * ServerIds to restart
     * @var array
     */
    private $servers = null;
    
    /**
     * Constructor for RestartPhp method
     * 
     * @param array $servers ServerIds to restart
     */
    public function __construct(array $servers = array())
    {
        $this->servers = $servers;
        parent::__construct();
    }
    
    /**
     * @see \ZendServerAPI\Method::configure()
     */
    function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/restartPhp');
        $this->setParser(new \ZendServerAPI\Mapper\ServersList());
    }

    /**
     * Content for POST request
     * 
     * @return string
     */
    public function getContent()
    {
        $content = "";
        $parameterCount = count($this->servers);
    
        foreach($this->servers as $index => $server)
        {
            $content .= urlencode("servers[".$index."]")."=".$server;
            if($index+1 < $parameterCount)
                $content .= "&";
        }
    
        return $content;
    }

}

?>