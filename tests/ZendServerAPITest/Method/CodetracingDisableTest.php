<?php
namespace ZendServerAPITest;
/**
 * test case.
 */
class CodetracingDisableTest extends \PHPUnit_Framework_TestCase
{
    public static function getResponse()
    {
        return file_get_contents(__DIR__.'/../DataTypes/TestAsset/codetracingstatus.xml');
    }
    
    public function testParseResult()
    {
        $method = new \ZendServerAPI\Method\CodetracingDisable();
        $result = $method->parseResponse(self::getResponse());
        
        $this->assertEquals($result->getComponentStatus(), 'Inactive');
        $this->assertTrue($result->getAlwaysDump());
        $this->assertTrue($result->getTraceEnabled());
        $this->assertFalse($result->getAwaitsRestart());
    }
    
    public function testDefaultRestartNow()
    {
        $codetraceDisableMethod = new \ZendServerAPI\Method\CodetracingDisable();
        $this->assertEquals('restartNow=TRUE', $codetraceDisableMethod->getContent());
    }
    
    public function testLink()
    {
        $codetraceDisableMethod = new \ZendServerAPI\Method\CodetracingDisable();
        $this->assertEquals('/ZendServerManager/Api/codetracingDisable', $codetraceDisableMethod->getLink());
    }
    
    public function testMethod()
    {
        $codetraceDisableMethod = new \ZendServerAPI\Method\CodetracingDisable();
        $this->assertEquals('POST', $codetraceDisableMethod->getMethod());
    }
    
    public function testAcceptHeader()
    {
        $codetraceDisableMethod = new \ZendServerAPI\Method\CodetracingDisable();
        $this->assertEquals('application/vnd.zend.serverapi+xml;version=1.2', $codetraceDisableMethod->getAcceptHeader());
    }
}

