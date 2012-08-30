<?php

use ZendServerAPI\Request;

use ZendServerAPI\BaseAPI;

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * test case.
 */
class BaseAPITest extends PHPUnit_Framework_TestCase
{
    public function testGettersAndSetters()
    {
        $baseAPI = new BaseAPI();
        $request = new Request();
        
        $baseAPI->setRequest($request);
        
        $this->assertSame($request, $baseAPI->getRequest());
    }
}

