<?php
namespace ZendServerAPITest;
/**
 * test case.
 */
class CodetracingEnableTest extends \PHPUnit_Framework_TestCase
{
    public function testDefaultRestartNow()
    {
        $codetraceEnableMethod = new \ZendServerAPI\Method\CodetracingEnable();
        $this->assertEquals('restartNow=TRUE', $codetraceEnableMethod->getContent());
    }
    
    public static function getResponse()
    {
        return file_get_contents(__DIR__.'/../DataTypes/TestAsset/codetracingstatus.xml');
    }
    
    public function testLink()
    {
        $codetraceEnableMethod = new \ZendServerAPI\Method\CodetracingEnable();
        $this->assertEquals('/ZendServerManager/Api/codetracingEnable', $codetraceEnableMethod->getLink());
    }
    
    public function testMethod()
    {
        $codetraceEnableMethod = new \ZendServerAPI\Method\CodetracingEnable();
        $this->assertEquals('POST', $codetraceEnableMethod->getMethod());
    }
    
    public function testAcceptHeader()
    {
        $codetraceEnableMethod = new \ZendServerAPI\Method\CodetracingEnable();
        $this->assertEquals('application/vnd.zend.serverapi+xml;version=1.2', $codetraceEnableMethod->getAcceptHeader());
    }
}

