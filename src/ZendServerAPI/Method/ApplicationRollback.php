<?php
namespace ZendServerAPI\Method;

class ApplicationRollback extends \ZendServerAPI\Method
{
    /**
     * Application ID to rollback
     * @var int
     */
    private $appId = null;
    
    /**
     * Constructor for ApplicationRollback method
     * 
     * @param int $appId ApplicationId to rollback
     */
    public function __construct($appId)
    {
        $this->appId = $appId;
        parent::__construct();
    }
    
    /**
     * @see \ZendServerAPI\Method::configure()
     */
    public function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/applicationRollback');
        $this->setParser(new \ZendServerAPI\Mapper\ApplicationInfo());
    }

    /**
     * Content for POST request
     * 
     * @return string
     */
    public function getContent()
    {
        return ("appId=".$this->appId);
    }
}

?>