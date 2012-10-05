<?php
namespace ZendServerAPITest;

use ZendServerAPI\Adapter\ServersList;

/**
 * test case.
 */
class ServersListAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testSuperClass()
    {
        $this->assertInstanceOf("\ZendServerAPI\Adapter\Adapter", new ServersList());
    }
}

