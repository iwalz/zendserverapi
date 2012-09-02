<?php
namespace ZendServerAPITest\Method;

use ZendServerAPI\DataTypes\MessageList;

use ZendServerAPI\DataTypes\ServerInfo;

use ZendServerAPI\Method\ClusterEnableServer;

/**
 * test case.
 */
class ClusterEnableServerTest extends \PHPUnit_Framework_TestCase
{
    public static $ClusterEnableServerObject = null;
    public static $ClusterEnableServerResponse = <<<EOF
    <zendServerAPIResponse xmlns="http://www.zend.com/server/api/1.0">
        <requestData>
            <apiKeyName>angel.eyes</apiKeyName>
            <method>clusterEnableServer</method>
        </requestData>
        <responseData>
            <serverInfo>
                <id>5</id>
                <name>www-02</name>
                <address>https://www-02.local:10082/ZendServer</address>
                <status>pendingRestart</status>
                <messageList />
            </serverInfo>
        </responseData>
    </zendServerAPIResponse>
EOF;
    
    public function testParseResult()
    {
        $action = new ClusterEnableServer();
        $clusterEnableServer = $action->parseResponse(self::$ClusterEnableServerResponse);
        
        $testClusterEnableServer = self::getClusterEnableServer();
        
        $this->assertEquals($testClusterEnableServer, $clusterEnableServer);
    }
    
    public static function getClusterEnableServer()
    {
        $testClusterEnableServer = new ServerInfo();
        $testClusterEnableServer->setId(5);
        $testClusterEnableServer->setName("www-02");
        $testClusterEnableServer->setAddress("https://www-02.local:10082/ZendServer");
        $testClusterEnableServer->setStatus("pendingRestart");
        $testClusterEnableServer->setMessageList(new MessageList());
        
        self::$ClusterEnableServerObject = $testClusterEnableServer;
        
        return self::$ClusterEnableServerObject;
    }
}
