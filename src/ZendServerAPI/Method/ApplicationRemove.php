<?php
namespace ZendServerAPI\Method;

class ApplicationRemove extends \ZendServerAPI\Method
{
    /**
     * ApplicationId to remove
     * @var int
     */
    private $applicationId = null;

    /**
     * Constructor for ApplicationRemove method
     *
     * @param int $applicationId ApplicationId to remove
     */
    public function __construct($applicationId)
    {
        $this->applicationId = $applicationId;
        parent::__construct();
    }

    /**
     * @see \ZendServerAPI\Method::configure()
     */
    public function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/applicationRemove');
        $this->setParser(new \ZendServerAPI\Mapper\ApplicationInfo());
    }

    /**
     * Content for POST request
     *
     * @return string
     */
    public function getContent()
    {
        return ("appId=".$this->applicationId);
    }
}
