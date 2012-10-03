<?php
namespace ZendServerAPI\Method;

use ZendServerAPI\Mapper\CodetracingDownloadTraceFile as CodetracingDownloadTraceFileMapper;

use ZendServerAPI\Mapper\DumpParser;

use ZendServerAPI\Mapper\ConfigurationExport as ConfigExportMapper;

class CodetracingDownloadTraceFile extends \ZendServerAPI\Method
{
    protected $traceFile = null; 
    protected $fileName = null;
    protected $exportDirectory = null;
    
    /**
     *
     * @param string $traceFile
     */
    public function __construct($traceFile, $fileName = null, $exportDirectory = null)
    {
        parent::__construct();

        
        $this->traceFile = $traceFile;
        $this->setExportDirectory($exportDirectory);
        $this->setFileName($fileName);
    }

    public function configure()
    {
        $this->setFunctionPath('/ZendServerManager/Api/codetracingDownloadTraceFile');
        $this->setMethod('GET');
        $this->setParser(new CodetracingDownloadTraceFileMapper());
    }
    
    public function getLink() 
    {
        $link = parent::getLink();
        $link .= '?traceFile='.$this->traceFile;
        
        return $link;
    }

    public function getAcceptHeader()
    {
        return "application/vnd.zend.serverapi+xml;version=1.2";
    }

    public function getExportDirectory()
    {
        return $this->getParser()->getExportDirectory();
    }
    
    public function setExportDirectory($exportDirectory)
    {
        $this->getParser()->setExportDirectory($exportDirectory);
    }
    
    public function setFileName($fileName)
    {
        $this->getParser()->setFileName($fileName);
    }
    
    public function getFileName()
    {
        return $this->getParser()->getFileName();
    }
}
