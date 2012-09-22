<?php

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * test case.
 */
class CodetracingTest extends PHPUnit_Framework_TestCase
{
    public function testGetterAndSetter()
    {
//         $codetracing = new \ZendServerAPI\Codetracing("example62");
    }
    
    public function testCodetracingEnableDisable()
    {
        $codetracing = new \ZendServerAPI\Codetracing("example62");
        var_dump($codetracing->codetracingEnable());
    }
}

