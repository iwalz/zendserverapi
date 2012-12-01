<?php
namespace ZendServerAPITest;

/**
 * test case.
 */
class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    public function testParentClass()
    {
        $configuration = new \ZendService\ZendServerAPI\Configuration();
        
        $this->assertInstanceOf('\ZendService\ZendServerAPI\BaseAPI', $configuration);
        $this->assertNotNull($configuration->getRequest());
    }
}

