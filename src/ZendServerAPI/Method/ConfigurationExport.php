<?php
namespace ZendServerAPI\Method;

use ZendServerAPI\Mapper\ConfigurationExport as ConfigExportMapper;

class ConfigurationExport extends \ZendServerAPI\Method
{
    /**
     *
     * @param string $exportDirectory
     */
    public function __construct($exportDirectory = null, $fileName = null)
    {
        parent::__construct();

        if($exportDirectory !== null)
            $this->setExportDirectory($exportDirectory);

        if($fileName !== null)
            $this->setFileName($fileName);
    }

    public function configure()
    {
        $this->setFunctionPath('/ZendServerManager/Api/configurationExport');
        $this->setMethod('GET');
        $this->setParser(new ConfigExportMapper());
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
