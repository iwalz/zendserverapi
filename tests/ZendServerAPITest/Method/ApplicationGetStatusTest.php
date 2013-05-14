<?php
namespace ZendServerAPITest;
/**
 * test case.
 */
class ApplicationGetStatusTest extends \PHPUnit_Framework_TestCase
{
    public function testLink()
    {
        $method = new \ZendService\ZendServerAPI\Method\ApplicationGetStatus();
        $method->setArgs(array(1,2));

       $this->assertEquals("/Api/applicationGetStatus?applications[0]=1&applications[1]=2", $method->getLink());
    }
    
    public static function getResponse()
    {
        return file_get_contents(__DIR__.'/../DataTypes/TestAsset/applicationlist.xml');
    }
}

