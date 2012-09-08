<?php
namespace ZendServerAPI\Mapper;

use ZendServerAPI\Exception\ClientSide;

class ConfigurationExport extends Mapper
{
    private $importDirectory = null;
    private $exportDirectory = null;
    
	/* 
     * @see \ZendServerAPI\Mapper\Mapper::parse()
     */
    function parse ()
    {
        $contentDisposition = $this->getResponse()->getContentDisposition();
        $parts = explode("\"", $contentDisposition);
        $fileName = $this->exportDirectory . DIRECTORY_SEPARATOR . $parts[1];
        file_put_contents( $fileName, $this->getResponse()->getBody());
        
        return new \SplFileInfo($fileName);
    }
    
    public function getImportDirectory()
    {
        return $this->importDirectory;
    }
    
    public function setImportDirectory($importDirectory)
    {
        $this->importDirectory = $this->checkPermission($importDirectory);
    }
    
    public function getExportDirectory()
    {
        return $this->exportDirectory;
    }
    
    public function setExportDirectory($exportDirectory)
    {
        $this->exportDirectory = $this->checkPermission($exportDirectory);
    }
    
    private function checkPermission($directory)
    {
        $directoryRealpath = realpath($directory);
        if(!is_dir($directory))
            throw new \InvalidArgumentException("Directory " . $directory . " does not exist");
        if(!is_writable($directory))
            throw new \InvalidArgumentException("Directory " . $directory . " is not writeable");
        
        return $directoryRealpath;
    }
}

?>