<?php

use ZendServerAPI\Request;

use Zend\Di\Di;

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
        $di = new Di();
        $request = new Request();
        
        $baseAPI->setDi($di);
        $baseAPI->setRequest($request);
        
        $this->assertSame($di, $baseAPI->getDi());
        $this->assertSame($request, $baseAPI->getRequest());
    }
}

