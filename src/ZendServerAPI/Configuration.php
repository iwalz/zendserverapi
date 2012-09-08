<?php
namespace ZendServerAPI;

class Configuration extends BaseAPI
{
    /**
     * The config file to import
     * @var string
     */
    protected $importFile = null;
    /**
     * Directory where to save exported configs
     * @var string
     */
    protected $exportDirectory = null;
    
    /**
     * Constructor for Configuration Zend Server API section 
     * 
     * @param string $name Name for config
     * @param string Config file to import
     * @param string Directory where to save exported configs
     * @param \ZendServerAPI\Request $request
     */
    public function __construct($name = null, $importFile = null, $exportDirectory = null, Request $request = null)
    {
        parent::__construct($name);
        
        if($importFile !== null)
            $this->importFile = $importFile;
        
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
    public function configurationExport($exportDirectory = null, $fileName = null)
    {
        if($exportDirectory !== null)
            $this->exportDirectory = $exportDirectory;
        
        $this->request->setAction(new \ZendServerAPI\Method\ConfigurationExport($this->exportDirectory, $fileName));
        
        return $this->request->send();
    }
    
    /**
     * Import a local config file
     *
     * @param string $importFile File to import
     * @return \ZendServerAPI\DataTypes\ServersList
     */
    public function configurationImport($importFile = null)
    {
        if($importFile !== null)
            $this->importFile = $importFile;
            
        $this->request->setAction(new \ZendServerAPI\Method\ConfigurationImport($this->importFile));
        
        return $this->request->send();
    }
    
    /**
     * Get the config file to import
     * 
     * @return string
     */
    public function getImportFile()
    {
        return $this->importFile;
    }
    
    /**
     * Set the import config file
     * 
     * @param string $importFile Full path to file
     */
    public function setImportFile($importFile)
    {
        $this->importFile = $importFile;
    }
    
    /**
     * Get the directory for saving the configs
     * 
     * @return string
     */
    public function getExportDirectory()
    {
        return $this->exportDirectory;
    }
    
    /**
     * Directory for exported config files
     * 
     * @param string $exportDirectory
     */
    public function setExportDirectory($exportDirectory)
    {
        $this->exportDirectory = $exportDirectory;
    }
}

?>