<?php
namespace ZendServerAPITest\Method;

use \ZendService\ZendServerAPI\DataTypes\MessageList;

use \ZendService\ZendServerAPI\DataTypes\ServerInfo;

use \ZendService\ZendServerAPI\DataTypes\ServersList;

use \ZendService\ZendServerAPI\Method\ClusterReconfigureServer;

/**
 * test case.
 */
class ClusterReconfigureServerTest extends \PHPUnit_Framework_TestCase
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
        $action->setArgs(self::getParameter());
        $clusterReconfigureServer = $action->parseResponse(self::$ClusterReconfigureServerResponse);
        
        $testClusterReconfigureServer = self::getClusterReconfigureServer();
        
        $this->assertEquals($clusterReconfigureServer, $testClusterReconfigureServer);
    }
    
    public static function getClusterReconfigureServer()
    {
        $server1 = new ServerInfo();
        $server1->setId(5);
        $server1->setName("www-02");
        $server1->setAddress("https://www-02.local:10082/ZendServer");
        $server1->setStatus("pendingRestart");
        $server1->setMessageList(new MessageList());
        
        self::$ClusterReconfigureServerObject = $server1;
        
        return self::$ClusterReconfigureServerObject;
        
    }
    
    public static function getParameter()
    {
        return 5;
    }
    
    public function testLink()
    {
        $action = new ClusterReconfigureServer();
        $action->setArgs(self::getParameter());
        $this->assertEquals('/Api/clusterReconfigureServer', $action->getLink());
    }
    
    public function testContent()
    {
        $action = new ClusterReconfigureServer();
        $action->setArgs(self::getParameter());
        $this->assertEquals('serverId=5&doRestart=FALSE', $action->getContent());
    }
    
    public function testContentWithDoRestart()
    {
        $action = new ClusterReconfigureServer();
        $action->setArgs(self::getParameter(), true);
        $this->assertEquals('serverId=5&doRestart=TRUE', $action->getContent());
    }
}
