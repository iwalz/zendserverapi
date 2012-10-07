<?php
namespace ZendServerAPI\Method;

class MonitorGetIssuesDetails extends \ZendServerAPI\Method
{
    /**
     * The issue ID of the issue to get the details for
     * @var string
     */
    protected $issueId = null;

    /**
     * Constructor of method MonitorGetIssuesDetails
     *
     * Retrieves the details of the given issue id.
     *
     * @param  string                                        $issueId      The issue ID
     * @param  Integer|95                                    $eventGroupId The event group identifier
     * @return \ZendServerAPI\Method\MonitorGetIssuesDetails
     */
    public function __construct($issueId)
    {
        $this->issueId = $issueId;
        parent::__construct();
    }

    /**
     * @see \ZendServerAPI\Method::configure()
     */
    public function configure ()
    {
        $this->setMethod('GET');
        $this->setFunctionPath('/ZendServerManager/Api/monitorGetIssueDetails');
        $this->setParser(new \ZendServerAPI\Adapter\IssueDetails());
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

        return $link;
    }
}
