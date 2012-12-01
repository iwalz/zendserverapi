<?php

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * test case.
 */
class SuperGlobalsTest extends PHPUnit_Framework_TestCase
{

    /**
     * Constructs the test case.
     */
    public function testGettersAndSetters()
    {
        $superglobals = new \ZendService\ZendServerAPI\DataTypes\SuperGlobals();
        
        $superglobals->addCookieParameter("foo", "bar");
        $superglobals->addServerParameter("bar", "foo");
        
        $this->assertEquals($superglobals->getServerParameter(), array('bar' => 'foo'));
        $this->assertEquals($superglobals->getServerParameter('bar'), 'foo');
    }
}

