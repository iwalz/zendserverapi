<?php

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * test case.
 */
class CodetracingTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->markTestSkipped();
    }
    
    public function testCodetracingEnableDisable()
    {
        $codetracing = new \ZendServerAPI\Codetracing("example62");
        $status = $codetracing->codetracingEnable();
        $this->assertEquals($status->getTraceEnabled(), '1');
        
        $status = $codetracing->codetracingDisable();
        $this->assertEquals($status->getTraceEnabled(), '0');
    }
}

