<?php
namespace ZendServerAPI\Method;

use ZendServerAPI\Adapter\ConfigurationExport as ConfigExportAdapter;

class MonitorExportIssueByEventsGroup extends \ZendServerAPI\Method
{
    protected $eventsGroupId = null;
    
    /**
     *
     * @param string $exportDirectory
     */
    public function __construct($eventsGroupId, $exportDirectory = null, $fileName = null)
    {
        parent::__construct();

        if($exportDirectory !== null)
            $this->setExportDirectory($exportDirectory);

        if($fileName !== null)
            $this->setFileName($fileName);
        
        $this->eventsGroupId = $eventsGroupId;    
    }

    public function configure()
    {
        $this->setFunctionPath('/ZendServerManager/Api/monitorExportIssueByEventsGroup');
        $this->setMethod('GET');
        $this->setParser(new \ZendServerAPI\Adapter\MonitorExportIssueByEventsGroup());
    }

    public function getAcceptHeader()
    {
        return "application/vnd.zend.serverapi+xml;version=1.2";
    }
    
    public function getLink()
    {
        $link = parent::getLink();
        $link .= '?eventGroupId='.$this->eventsGroupId;
        
        return $link;
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
