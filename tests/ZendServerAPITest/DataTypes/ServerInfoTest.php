<?php

use ZendServerAPI\DataTypes\MessageList;

use ZendServerAPI\DataTypes\ServerInfo;

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * test case.
 */
class ServerInfoTest extends PHPUnit_Framework_TestCase
{

    public function testGettersAndSetters ()
    {
        $serverInfo = new ServerInfo();
        
        $address = "Foo";
        $serverInfo->setAddress($address);
        $this->assertSame($address, $serverInfo->getAddress());
        
        $id = "123";
        $serverInfo->setId($id);
        $this->assertSame((int)$id, $serverInfo->getId());
        $this->assertInternalType('int', $serverInfo->getId());
        
        $messageList = new MessageList();
        $serverInfo->setMessageList($messageList);
        $this->assertSame($messageList, $serverInfo->getMessageList());
        
        $status = "OK";
        $serverInfo->setStatus($status);
        $this->assertSame($status, $serverInfo->getStatus());
        
        $name = "Bar";
        $serverInfo->setName($name);
        $this->assertSame($name, $serverInfo->getName());
    }
}

