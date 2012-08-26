<?php
namespace ZendServerAPITest;

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
        
        $testClusterEnableServer = new ServerInfo();
        
        self::$ClusterEnableServerObject = $testClusterEnableServer;
    }
}
