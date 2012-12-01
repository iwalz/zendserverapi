<?php
namespace ZendServerAPITest\Method;

/**
 * test case.
 */
class ConfigurationExportTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $action = new \ZendService\ZendServerAPI\Method\ConfigurationExport();
        $this->assertInstanceOf('\ZendService\ZendServerAPI\Method\Method', $action);
    }
}

