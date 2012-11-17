<?php
namespace ZendServerAPI\Method;

/**
 * test case.
 */
class ConfigurationExportTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $action = new \ZendServerAPI\Method\ConfigurationExport();
        $this->assertInstanceOf('\ZendServerAPI\Method\Method', $action);
    }
}

