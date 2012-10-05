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
     * Restart servers in parallel
     * @var boolean
     */
    private $parallelRestart = null;

    /**
     * Constructor for RestartPhp method
     *
     * @param array $servers ServerIds to restart
     */
    public function __construct(array $servers = array(), $parallelRestart = false)
    {
        $this->servers = $servers;
        $this->parallelRestart = $parallelRestart;
        parent::__construct();
    }

    /**
     * @see \ZendServerAPI\Method::configure()
     */
    public function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/restartPhp');
        $this->setParser(new \ZendServerAPI\Adapter\ServersList());
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

        foreach ($this->servers as $index => $server) {
            $content .= urlencode("servers[".$index."]")."=".$server;
            if($index+1 < $parameterCount)
                $content .= "&";
        }
        $content .= "&parallelRestart=".($this->parallelRestart === true ? 'TRUE' : 'FALSE');

        return $content;
    }

}
