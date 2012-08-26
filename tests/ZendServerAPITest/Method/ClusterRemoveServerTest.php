<?php
namespace ZendServerAPITest;

use ZendServerAPI\DataTypes\ServerInfo;

use ZendServerAPI\Method\ClusterReconfigureServer;

/**
 * test case.
 */
class ClusterRemoveServerTest extends \PHPUnit_Framework_TestCase
{
    public static $ClusterReconfigureServerObject = null;
    public static $ClusterReconfigureServerResponse = <<<EOF
    <zendServerAPIResponse xmlns="http://www.zend.com/server/api/1.1">
        <requestData>
            <apiKeyName>angel.eyes</apiKeyName>
            <method>clusterReconfigureServer</method>
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
        $action = new ClusterReconfigureServer();
        $clusterReconfigureServer = $action->parseResponse(self::$ClusterReconfigureServerResponse);
        
        $testClusterReconfigureServer = new ServerInfo();
        
        self::$ClusterReconfigureServerObject = $testClusterReconfigureServer;
    }
}
