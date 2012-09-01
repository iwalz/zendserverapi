<?php
namespace ZendServerAPITest;

use ZendServerAPI\DataTypes\MessageList;

use ZendServerAPI\Method\ClusterAddServer;
use ZendServerAPI\DataTypes\ServerInfo;

/**
 * test case.
 */
class ClusterAddServerTest extends \PHPUnit_Framework_TestCase
{
    public static $ClusterAddServerObject = null;
    public static $ClusterAddServerResponse = <<<EOF
    <zendServerAPIResponse xmlns="http://www.zend.com/server/api/1.0">
        <requestData>
            <apiKeyName>angel.eyes</apiKeyName>
            <method>clusterAddServer</method>
        </requestData>
        <responseData>
            <serverInfo>
                <id>25</id>
                <name>www-05</name>
                <address>https://www-05.local:10082/ZendServer</address>
                <status>OK</status>
                <messageList />
            </serverInfo>
        </responseData>
    </zendServerAPIResponse>
    
EOF;

    public function testParseResult()
    {
        $action = new ClusterAddServer(self::getServerName(), self::getServerUrl(), self::getGuiPassword());
        $clusterAddServer = $action->parseResponse(self::$ClusterAddServerResponse);

        $testClusterAddServer = self::getAddServerObject();
        
        $this->assertEquals($testClusterAddServer, $clusterAddServer);
        
        self::$ClusterAddServerObject = $testClusterAddServer;
    }
    
    public static function getAddServerObject()
    {
        $testClusterAddServer = new ServerInfo();
        $testClusterAddServer->setId(25);
        $testClusterAddServer->setName("www-05");
        $testClusterAddServer->setStatus("OK");
        $testClusterAddServer->setAddress("https://www-05.local:10082/ZendServer");
        $testClusterAddServer->setMessageList(new MessageList());

        self::$ClusterAddServerObject = $testClusterAddServer;
        return $testClusterAddServer;
    }
    
    public static function getServerName()
    {
        return 'www-05';
    }
    
    public static function getServerUrl()
    {
        return 'https://www-05.local:10081/ZendServer';
    }
    
    public static function getGuiPassword()
    {
        return 'somepassword';
    }

}

