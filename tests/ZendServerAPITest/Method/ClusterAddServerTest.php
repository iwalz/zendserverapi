<?php
namespace ZendServerAPITest;

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
        $action = new ClusterAddServer();
        $clusterAddServer = $action->parseResponse(self::$ClusterAddServerResponse);

        $testClusterAddServer = new ServerInfo();
        
        self::$ClusterAddServerObject = $testClusterAddServer;
    }

}

