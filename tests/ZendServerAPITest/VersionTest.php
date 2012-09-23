<?php
namespace ZendServerAPITest;

/**
 * test case.
 */
class VersionTest extends \PHPUnit_Framework_TestCase
{
    public function testAPIVersions()
    {
        $this->assertEquals("1.0", \ZendServerAPI\Version::ZS51);
        $this->assertEquals("1.1", \ZendServerAPI\Version::ZS55);
        $this->assertEquals("1.2", \ZendServerAPI\Version::ZS56);
        
        $this->assertEquals("1.0", \ZendServerAPI\Version::ZSCE51);
        $this->assertEquals("1.1", \ZendServerAPI\Version::ZSCE55);
        $this->assertEquals("1.2", \ZendServerAPI\Version::ZSCE56);
        
        $this->assertEquals("1.0", \ZendServerAPI\Version::ZSCM51);
        $this->assertEquals("1.1", \ZendServerAPI\Version::ZSCM55);
        $this->assertEquals("1.2", \ZendServerAPI\Version::ZSCM56);
    }
}

