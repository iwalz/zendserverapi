<?php
namespace ZendServerAPITest;
/**
 * test case.
 */
class CodetracingEnableTest extends \PHPUnit_Framework_TestCase
{
    public function testDefaultRestartNow()
    {
        $codetraceEnableMethod = new \ZendService\ZendServerAPI\Method\CodetracingEnable();
        $codetraceEnableMethod->setArgs();
        $this->assertEquals('restartNow=TRUE', $codetraceEnableMethod->getContent());
    }
    
    public static function getResponse()
    {
        return file_get_contents(__DIR__.'/../DataTypes/TestAsset/codetracingstatus.xml');
    }
    
    public function testLink()
    {
        $codetraceEnableMethod = new \ZendService\ZendServerAPI\Method\CodetracingEnable();
        $codetraceEnableMethod->setArgs();
        $this->assertEquals('/Api/codetracingEnable', $codetraceEnableMethod->getLink());
    }
    
    public function testMethod()
    {
        $codetraceEnableMethod = new \ZendService\ZendServerAPI\Method\CodetracingEnable();
        $codetraceEnableMethod->setArgs();
        $this->assertEquals('POST', $codetraceEnableMethod->getMethod());
    }
    
    public function testAcceptHeader()
    {
        $codetraceEnableMethod = new \ZendService\ZendServerAPI\Method\CodetracingEnable();
        $codetraceEnableMethod->setArgs();
        $this->assertEquals('application/vnd.zend.serverapi+xml;version=1.2', $codetraceEnableMethod->getAcceptHeader());
    }
}

