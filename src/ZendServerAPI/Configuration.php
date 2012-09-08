<?php
namespace ZendServerAPI;

class Configuration extends BaseAPI
{
    /**
     * Directory where to get imported configs
     * @var string
     */
    protected $importDirectory = null;
    /**
     * Directory where to save exported configs
     * @var string
     */
    protected $exportDirectory = null;
    
    /**
     * Constructor for Configuration Zend Server API section 
     * 
     * @param string $name Name for config
     * @param string Directory where to get imported configs
     * @param string Directory where to save exported configs
     * @param \ZendServerAPI\Request $request
     */
    public function __construct($name = null, $importDirectory = null, $exportDirectory = null, Request $request = null)
    {
        parent::__construct($name);
        
        if($importDirectory !== null)
            $this->importDirectory = $importDirectory;
        
        if($exportDirectory !== null)
            $this->exportDirectory = $exportDirectory;
        
        if($request !== null)
            $this->request = $request;
    }
    
    /**
     * Export the configuration and store locally
     * 
     * @param string $exportDirectory Directory where to save the exported configs
     * @return \SplFileInfo
     */
    public function configurationExport($exportDirectory = null)
    {
        if($exportDirectory !== null)
            $this->exportDirectory = $exportDirectory;
        
        $action = new \ZendServerAPI\Method\ConfigurationExport();
        $action->setExportDirectory($this->exportDirectory);
        $this->request->setAction($action);
        
        return $this->request->send();
    }
    
    public function getImportDirectory()
    {
        return $this->importDirectory;
    }
    
    public function setImportDirectory($importDirectory)
    {
        $this->importDirectory = $importDirectory;
    }
    
    public function getExportDirectory()
    {
        return $this->exportDirectory;
    }
    
    public function setExportDirectory($exportDirectory)
    {
        $this->exportDirectory = $exportDirectory;
    }
}

?>