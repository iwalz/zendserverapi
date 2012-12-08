<?php

namespace ZendServerAPITest\Integration;

class MonitorIntegrationTest extends \ZendServerAPITest\Integration\BaseAPIIntegration
{
    public function setUp() 
    {
        $this->mockObject = new \ZendService\ZendServerAPI\Monitor();
        $this->object = new \ZendService\ZendServerAPI\Monitor(self::LOCAL);
        parent::setUp();
    }
    
    public function getMonitorExportIssueByEventsGroup()
    {
        $fileInfo = new \SplFileInfo('/var/www/zsapi/Fatal_PHP_Error-28-283-20121208.zsf');
        return $fileInfo;
    }
    
    public function mockProvider()
    {
        static::$mockDataProvider = array(
            array("monitorExportIssueByEventsGroup", $this->getMonitorExportIssueByEventsGroup(), array(28, 283))
        );
                 
        return static::$mockDataProvider;
    }   
    
    public function productionProvider()
    {
        static::$localDataProvider = array(
                array("monitorGetIssueDetails", array(28), self::LOCAL)
        );
         
        return static::$localDataProvider;
    }

    public function getSection()
    {
        return "monitor";
    }
}

