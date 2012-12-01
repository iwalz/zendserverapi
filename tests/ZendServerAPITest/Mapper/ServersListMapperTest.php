<?php
namespace ZendServerAPITest;

use \ZendService\ZendServerAPI\Adapter\ServersList;

/**
 * test case.
 */
class ServersListAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testSuperClass()
    {
        $this->assertInstanceOf("\ZendService\ZendServerAPI\Adapter\Adapter", new ServersList());
    }
}

