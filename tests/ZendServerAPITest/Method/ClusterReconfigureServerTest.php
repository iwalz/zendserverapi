<?php
namespace ZendServerAPITest;

use ZendServerAPI\DataTypes\ServersList;

use ZendServerAPI\Method\ClusterReconfigureServer;

/**
 * test case.
 */
class ClusterReconfigureServerTest extends \PHPUnit_Framework_TestCase
{
    public static $ClusterReconfigureServerObject = null;
    public static $ClusterReconfigureServerResponse = <<<EOF
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
    
    public function testParseResult()
    {
        $action = new ClusterReconfigureServer();
        $clusterReconfigureServer = $action->parseResponse(self::$ClusterReconfigureServerResponse);
        
        $testClusterReconfigureServer = new ServersList();
        
        self::$ClusterReconfigureServerObject = $testClusterReconfigureServer;
    }
}
