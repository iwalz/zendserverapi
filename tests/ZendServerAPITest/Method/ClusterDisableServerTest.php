<?php
namespace ZendServerAPITest;

use ZendServerAPI\DataTypes\MessageList;

use ZendServerAPI\Method\ClusterDisableServer,
    ZendServerAPI\DataTypes\ServerInfo;

/**
 * test case.
 */
class ClusterDisableServerTest extends \PHPUnit_Framework_TestCase
{
    public static $ClusterDisableServerObject = null;
    public static $ClusterDisableServerResponse = <<<EOF
    <zendServerAPIResponse xmlns="http://www.zend.com/server/api/1.0">
        <requestData>
            <apiKeyName>angel.eyes</apiKeyName>
            <method>clusterDisableServer</method>
        </requestData>
        <responseData>
            <serverInfo>
                <id>5</id>
                <name>www-02</name>
                <address>https://www-02.local:10082/ZendServer</address>
                <status>disabled</status>
                <messageList />
            </serverInfo>
        </responseData>
    </zendServerAPIResponse>
EOF;
    
    public function testParseResult()
    {
        $action = new ClusterDisableServer();
        $clusterDisableServer = $action->parseResponse(self::$ClusterDisableServerResponse);
        
        $testClusterDisableServer = self::getClusterDisableServer();
        
        $this->assertEquals($clusterDisableServer, $testClusterDisableServer);
    }
    
    public static function getClusterDisableServer()
    {
        $testClusterDisableServer = new ServerInfo();
        $testClusterDisableServer->setId(5);
        $testClusterDisableServer->setName("www-02");
        $testClusterDisableServer->setAddress("https://www-02.local:10082/ZendServer");
        $testClusterDisableServer->setStatus("disabled");
        $testClusterDisableServer->setMessageList(new MessageList());
        
        self::$ClusterDisableServerObject = $testClusterDisableServer;
        
        return self::$ClusterDisableServerObject;
        
    }
}
