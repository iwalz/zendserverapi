<?php
namespace ZendServerAPI\Method;

use ZendServerAPI\Mapper\ConfigurationExport as ConfigExportMapper;

class ConfigurationExport extends \ZendServerAPI\Method
{
    public function configure()
    {
        $this->setFunctionPath('/ZendServerManager/Api/configurationExport');
        $this->setMethod('GET');
        $this->setParser(new ConfigExportMapper());
    }
    
    public function getAcceptHeader()
    {
        return "application/vnd.zend.serverconfig";
    }
    
    public function getImportDirectory()
    {
        return $this->getParser()->getImportDirectory();
    }
    
    public function setImportDirectory($importDirectory)
    {
        $this->getParser()->setImportDirectory($importDirectory);
    }
    
    public function getExportDirectory()
    {
        return $this->getParser()->getExportDirectory();
    }
    
    public function setExportDirectory($exportDirectory)
    {
        $this->getParser()->setExportDirectory($exportDirectory);
    }
}

?>