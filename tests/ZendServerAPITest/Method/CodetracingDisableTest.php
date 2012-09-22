<?php
namespace ZendServerAPITest;
/**
 * test case.
 */
class CodetracingDisableTest extends \PHPUnit_Framework_TestCase
{
    public function testGetterAndSetter()
    {
        $this->markTestIncomplete();
    }
    
    public static function getResponse()
    {
        return file_get_contents(__DIR__.'/../DataTypes/TestAsset/codetracingstatus.xml');
    }
    
    public function testParseResult()
    {
        $method = new \ZendServerAPI\Method\CodetracingDisable();
        $result = $method->parseResponse(self::getResponse());
        
        $this->assertEquals($result->getComponentStatus(), 'Inactive');
        $this->assertEquals($result->getAlwaysDump(), 'Off');
        $this->assertEquals($result->getTraceEnabled(), 'Off');
        $this->assertEquals($result->getAwaitsRestart(), '0');
    }
}

