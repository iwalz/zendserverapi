<?php
namespace ZendServerAPI\Method;

class StudioStartProfile extends \ZendServerAPI\Method
{
    /**
     * Events group identifier
     * @var string
     */
    protected $eventsGroupId = null;
    /**
     * Override the host address sent to Zend Server for
     * initiating a Debug session. This is used to point Zend
     * Server at the right address where Studio is executed
     * @var boolean
     */
    protected $overrideHost = null;

    /**
     * Constructor for studioStartDebug method
     *
     * @param  string       $eventsGroupId   Events group ID
     * @param  string|null  $overrideHost    Override the host address sent to Zend Server 
     */
    public function __construct($eventsGroupId, $overrideHost = null)
    {
        $this->eventsGroupId = $eventsGroupId;
        if($overrideHost === null)
            $this->overrideHost = "127.0.0.1";
        else
            $this->overrideHost = $overrideHost;
        
        parent::__construct();
    }

    /**
     * @see \ZendServerAPI\Method::configure()
     */
    public function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/studioStartProfile');
        $this->setParser(new \ZendServerAPI\Adapter\DebugRequest());
    }
    
    public function getAcceptHeader()
    {
        return "application/vnd.zend.serverapi+xml;version=1.2";
    }

    /**
     * Content for POST request
     *
     * @return string
     */
    public function getContent()
    {
        return "eventGroupId=".$this->eventsGroupId.
            "&overrideHost=".$this->overrideHost;
    }
}
