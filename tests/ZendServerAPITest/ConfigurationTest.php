<?php
namespace ZendServerAPITest;

/**
 * test case.
 */
class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    public function testParentClass()
    {
        $configuration = new \ZendServerAPI\Configuration();
        
        $this->assertInstanceOf('\ZendServerAPI\BaseAPI', $configuration);
        $this->assertNotNull($configuration->getRequest());
    }
}

