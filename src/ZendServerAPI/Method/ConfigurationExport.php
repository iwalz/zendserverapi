<?php
namespace ZendServerAPI\Method;

use ZendServerAPI\Mapper\DumpParser;

class ConfigurationExport extends \ZendServerAPI\Method
{
    public function configure()
    {
        $this->setFunctionPath('/ZendServerManager/Api/configurationExport');
        $this->setMethod('GET');
        $this->setParser(new DumpParser());
    }
}

?>