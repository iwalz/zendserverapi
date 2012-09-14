<?php
namespace ZendServerAPI\Method;

class ApplicationGetStatus extends \ZendServerAPI\Method
{
    /**
     * Application ID's to get status for
     * @var array
     */
    private $applications = array();
    
    
    /**
     * Constructor of method ApplicationGetStatus
     * 
     * @param array Applications to get status for
     */
    public function __construct(array $applications = array())
    {
        $this->applications = $applications;
        parent::__construct();
    }
    
    /**
     * @see \ZendServerAPI\Method::configure()
     */
    public function configure ()
    {
        $this->setMethod('GET');
        $this->setFunctionPath('/ZendServerManager/Api/applicationGetStatus');
        $this->setParser(new \ZendServerAPI\Mapper\ApplicationList());
    }

    /**
     * @see \ZendServerAPI\Method::getLink()
     */
    public function getLink()
    {
        $link = $this->getFunctionPath();
        $parameterCount = count($this->applications);
        
        if($parameterCount > 0)
            $link .= "?";
        
        foreach($this->applications as $index => $application)
        {
            $link .= urlencode("applications[".$index."]")."=".$application;
            if($index+1 < $parameterCount)
                $link .= "&";
        } 
        
        return $link;
    }
}

?>