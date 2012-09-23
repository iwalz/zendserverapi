<?php
namespace ZendServerAPITest;
/**
 * test case.
 */
class CodetracingIsEnabledTest extends \PHPUnit_Framework_TestCase
{
    public static function getResponse()
    {
        return file_get_contents(__DIR__.'/../DataTypes/TestAsset/codetracingstatus.xml');
    }
    
    public function testLink()
    {
        $codetraceIsEnableMethod = new \ZendServerAPI\Method\CodetracingIsEnabled();
        $this->assertEquals('/ZendServerManager/Api/codetracingIsEnabled', $codetraceIsEnableMethod->getLink());
    }
    
    public function testMethod()
    {
        $codetraceIsEnableMethod = new \ZendServerAPI\Method\CodetracingIsEnabled();
        $this->assertEquals('GET', $codetraceIsEnableMethod->getMethod());
    }
    
    public function testAcceptHeader()
    {
        $codetraceIsEnableMethod = new \ZendServerAPI\Method\CodetracingIsEnabled();
        $this->assertEquals('application/vnd.zend.serverapi+xml;version=1.2', $codetraceIsEnableMethod->getAcceptHeader());
    }
}

