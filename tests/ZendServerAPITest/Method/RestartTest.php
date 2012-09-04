<?php
namespace ZendServerAPITest\Method;

use ZendServerAPI\DataTypes\MessageList;
use ZendServerAPI\DataTypes\ServerInfo;
use ZendServerAPI\DataTypes\ServersList;
use ZendServerAPI\Method\RestartPHP;

/**
 * test case.
 */
class RestartTest extends \PHPUnit_Framework_TestCase
{
    public static $RestartPHPObject = null;
    public static $RestartPHPResponse = <<<EOF
    <zendServerAPIResponse xmlns="http://www.zend.com/server/api/1.0">
        <requestData>
            <apiKeyName>angel.eyes</apiKeyName>
            <method>restartPhp</method>
        </requestData>
        <responseData>
            <serversList>
                <serverInfo>
                    <id>1</id>
                    <name>www-01</name>
                    <address>https://www-01.local:10082/ZendServer</address>
                    <status>restarting</status>
                    <messageList />
                </serverInfo>
                <serverInfo>
                    <id>2</id>
                    <name>www-02</name>
                    <address>https://www-02.local:10082/ZendServer</address>
                    <status>restarting</status>
                    <messageList />
                </serverInfo>
                <serverInfo>
                    <id>3</id>
                    <name>www-03</name>
                    <address>https://www-03.local:10082/ZendServer</address>
                    <status>OK</status>
                    <messageList />
                </serverInfo>
            </serversList>
        </responseData>
    </zendServerAPIResponse>
    
EOF;

    
    public static function getRestartPHP()
    {
        $testRestartPHP = new ServersList();
        $serversList = new ServersList();
        $server1 = new ServerInfo();
        $server1->setId(1);
        $server1->setName("www-01");
        $server1->setAddress("https://www-01.local:10082/ZendServer");
        $server1->setStatus("restarting");
        $server1->setMessageList(new MessageList());
    
        $server2 = new ServerInfo();
        $server2->setId(2);
        $server2->setName("www-02");
        $server2->setAddress("https://www-02.local:10082/ZendServer");
        $server2->setStatus("restarting");
        $server2->setMessageList(new MessageList());
    
        $server3 = new ServerInfo();
        $server3->setId(3);
        $server3->setName("www-03");
        $server3->setAddress("https://www-03.local:10082/ZendServer");
        $server3->setStatus("OK");
        $server3->setMessageList(new MessageList());
    
        $testRestartPHP->addServerInfo($server1);
        $testRestartPHP->addServerInfo($server2);
        $testRestartPHP->addServerInfo($server3);
    
        return $testRestartPHP;
    }
    
    public static function getParameter()
    {
        return array(1,2);
    }

    public function testLink()
    {
        $action = new \ZendServerAPI\Method\RestartPHP(self::getParameter());
    
        $this->assertEquals("/ZendServerManager/Api/restartPhp", $action->getLink());
    }
    
    public function testContent()
    {
        $action = new \ZendServerAPI\Method\RestartPHP(self::getParameter());
        $this->assertEquals("servers%5B0%5D=1&servers%5B1%5D=2&parallelRestart=FALSE", $action->getContent());
    }
    
    public function testContentWithParallelRestart()
    {
        $action = new \ZendServerAPI\Method\RestartPHP(self::getParameter(), true);
        $this->assertEquals("servers%5B0%5D=1&servers%5B1%5D=2&parallelRestart=TRUE", $action->getContent());
    }
}

