<?php
namespace ZendServerAPITest;

use ZendServerAPI\Mapper\ServersList;

/**
 * test case.
 */
class ServersListMapperTest extends \PHPUnit_Framework_TestCase
{
    public function testSuperClass()
    {
        $this->assertInstanceOf("\ZendServerAPI\Mapper\Mapper", new ServersList());
    }
}

