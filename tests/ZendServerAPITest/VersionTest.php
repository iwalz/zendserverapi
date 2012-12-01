<?php
namespace ZendServerAPITest;

/**
 * test case.
 */
class VersionTest extends \PHPUnit_Framework_TestCase
{
    public function testAPIVersions()
    {
        $this->assertEquals("1.0", \ZendService\ZendServerAPI\Version::ZS51);
        $this->assertEquals("1.1", \ZendService\ZendServerAPI\Version::ZS55);
        $this->assertEquals("1.2", \ZendService\ZendServerAPI\Version::ZS56);
        
        $this->assertEquals("1.0", \ZendService\ZendServerAPI\Version::ZSCE51);
        $this->assertEquals("1.1", \ZendService\ZendServerAPI\Version::ZSCE55);
        $this->assertEquals("1.2", \ZendService\ZendServerAPI\Version::ZSCE56);
        
        $this->assertEquals("1.0", \ZendService\ZendServerAPI\Version::ZSCM51);
        $this->assertEquals("1.1", \ZendService\ZendServerAPI\Version::ZSCM55);
        $this->assertEquals("1.2", \ZendService\ZendServerAPI\Version::ZSCM56);
    }
}

