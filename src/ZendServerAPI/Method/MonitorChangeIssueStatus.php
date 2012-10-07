<?php
namespace ZendServerAPI\Method;

class MonitorChangeIssueStatus extends \ZendServerAPI\Method
{
    /**
     * Issue IS
     * @var int
     */
    protected $issueId = null;
    protected $newStatus = null;
    

    /**
     * Constructor for ApplicationRemove method
     *
     * @param int $applicationId ApplicationId to remove
     */
    public function __construct($applicationId, $newStatus)
    {
        $this->applicationId = $applicationId;
        $this->newStatus = $newStatus;
        parent::__construct();
    }

    public function getContentType()
    {
        return "application/x-www-form-urlencoded";
    }
    
    public function getAcceptHeader()
    {
        return "application/vnd.zend.serverapi+xml;version=1.2";
    }
    
    /**
     * @see \ZendServerAPI\Method::configure()
     */
    public function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/monitorChangeIssueStatus');
        $this->setParser(new \ZendServerAPI\Adapter\Issue());
    }

    /**
     * Content for POST request
     *
     * @return string
     */
    public function getContent()
    {
        return ("issueId=".$this->applicationId
               ."&newStatus=".$this->newStatus);
    }
}
