<?php

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * test case.
 */
class CodetracingTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        if(DISABLE_REAL_INTERFACE === true)
            $this->markTestSkipped();
    }
    
    public function testCodetracing()
    {
        $this->markTestSkipped();
        $codetracing = new \ZendService\ZendServerAPI\Codetracing("example62");
        $status = $codetracing->codetracingCreate("http://hp.local");
        $fileinfo = $codetracing->codetracingDownloadTraceFile($status->getId(), "foo.amf", __DIR__.'/../../downloads');
        $this->assertFileExists($fileinfo->getPathName());
        unlink($fileinfo->getPathName());
        $id = $status->getId();
        $codetracing->codetracingDelete($id);
        $list = $codetracing->codetracingList();
        $this->assertContainsOnly($status, $list->getCodetracing());
    }
}

