<?php
namespace ZendServerAPI;

class Configuration extends BaseAPI
{
    /**
     * Constructor for Configuration Zend Server API section 
     * 
     * @param string $name Name for config
     * @param \ZendServerAPI\Request $request
     */
    public function __construct($name = null, Request $request = null)
    {
        parent::__construct($name);
         
        if($request !== null)
            $this->request = $request;
    }
    
    public function configurationExport()
    {
        $this->request->setAction(new \ZendServerAPI\Method\ConfigurationExport());
        return $this->request->send();
    }
}

?>