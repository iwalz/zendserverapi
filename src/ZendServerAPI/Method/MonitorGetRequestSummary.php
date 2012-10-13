<?php
namespace ZendServerAPI\Method;

class MonitorGetRequestSummary extends \ZendServerAPI\Method
{
    /**
     * Request identifier
     * @var string
     */
    private $requestUid = null;

    /**
     * Constructor of method ApplicationGetStatus
     *
     * @param array Applications to get status for
     */
    public function __construct($requestUid)
    {
        $this->requestUid = $requestUid;
        parent::__construct();
    }

    /**
     * @see \ZendServerAPI\Method::configure()
     */
    public function configure ()
    {
        $this->setMethod('GET');
        $this->setFunctionPath('/ZendServerManager/Api/monitorGetRequestSummary');
        $this->setParser(new \ZendServerAPI\Adapter\RequestSummary());
    }

    /**
     * @see \ZendServerAPI\Method::getLink()
     */
    public function getLink()
    {
        $link = $this->getFunctionPath();
        $link .= "?requestUid=".$this->requestUid;

        return $link;
    }
}
