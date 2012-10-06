<?php
namespace ZendServerAPI\Method;

class MonitorGetEventGroupDetails extends \ZendServerAPI\Method
{
    /**
     * The issue ID of the issue to get the details for
     * @var string
     */
    protected $issueId = null;
    protected $eventsGroupId = null;

    /**
     * Constructor of method MonitorGetEventGroupDetails 
     *
     * Retrieves the details of the given issue id.
     *
     * @param  string                                                       $issueId  The issue ID
     * @param  Integer                                                      $eventGroupId  The event group identifier
     * @return \ZendServerAPI\Method\MonitorGetEventGroupDetails
     */
    public function __construct($issueId, $eventsGroupId)
    {
        $this->issueId = $issueId;
        $this->eventsGroupId = $eventsGroupId;
        parent::__construct();
    }

    /**
     * @see \ZendServerAPI\Method::configure()
     */
    public function configure ()
    {
        $this->setMethod('GET');
        $this->setFunctionPath('/ZendServerManager/Api/monitorGetEventGroupDetails');
        $this->setParser(new \ZendServerAPI\Adapter\DumpParser());
    }

    public function getAcceptHeader()
    {
        return "application/vnd.zend.serverapi+xml;version=1.2";
    }

    /**
     * @see \ZendServerAPI\Method::getLink()
     */
    public function getLink()
    {
        $link = $this->getFunctionPath();
        $link .= "?issueId=".$this->issueId;
        $link .= "&eventGroupId=".$this->eventsGroupId;

        return $link;
    }
}
