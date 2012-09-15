<?php
namespace ZendServerAPI\Method;

use ZendServerAPI\Mapper\ServersList;

class ConfigurationImport extends \ZendServerAPI\Method
{
    private $file = null;
    
    public function __construct($file = null)
    {
        parent::__construct();
        
        $this->file = $file;
    }
    
    public function configure()
    {
        $this->setFunctionPath('/ZendServerManager/Api/configurationImport');
        $this->setMethod('POST');
        $this->setParser(new ServersList());
    }
    
    public function getContentType()
    {
        return 'application/x-www-form-urlencoded';
    }
    
    public function getPostFiles()
    {
        return array('configFile' => array('fileName' => $this->file, 'contentType' => 'application/vnd.zend.serverconfig'));
    }
    
    public function getContent()
    {
        return "";
    }
    
    public function getImportFile()
    {
        return $this->file;
    }
    
    public function setImportFile($importFile)
    {
        $this->file = $importFile;
    }
}

?>