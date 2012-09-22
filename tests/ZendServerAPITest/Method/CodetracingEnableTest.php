<?php
namespace ZendServerAPITest;
/**
 * test case.
 */
class CodetracingEnableTest extends \PHPUnit_Framework_TestCase
{
    public function testGetterAndSetter()
    {
        $this->markTestIncomplete();
    }
    
    public static function getResponse()
    {
        return file_get_contents(__DIR__.'/../DataTypes/TestAsset/codetracingstatus.xml');
    }
}

