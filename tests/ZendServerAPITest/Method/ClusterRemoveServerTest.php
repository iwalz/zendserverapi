<?php
namespace ZendServerAPITest\Method;

use \ZendService\ZendServerAPI\DataTypes\MessageList;

use \ZendService\ZendServerAPI\DataTypes\ServerInfo;

use \ZendService\ZendServerAPI\Method\ClusterRemoveServer;

/**
 * test case.
 */
class ClusterRemoveServerTest extends \PHPUnit_Framework_TestCase
{
    public static $ClusterRemoveServerObject = null;
    public static $ClusterRemoveServerResponse = <<<EOF
    <zendServerAPIResponse xmlns="http://www.zend.com/server/api/1.0">
        <requestData>
            <apiKeyName>angel.eyes</apiKeyName>
            <method>clusterRemoveServer</method>
        </requestData>
        <responseData>
            <serverInfo>
                <id>5</id>
                <name>www-02</name>
                <address>https://www-02.local:10082/ZendServer</address>
                <status>shuttingDown</status>
                <messageList />
            </serverInfo>
        </responseData>
    </zendServerAPIResponse>
EOF;
    
    public function testParseResult()
    {
        $action = new ClusterRemoveServer();
        $action->setArgs(self::getParameter());
        $clusterRemoveServer = $action->parseResponse(self::$ClusterRemoveServerResponse);
        $testClusterRemoveServer = self::getClusterRemoveServer();
        
        $this->assertEquals($clusterRemoveServer, $testClusterRemoveServer);
    }
    
    public static function getParameter()
    {
        return 5;
    }
    
    public static function getClusterRemoveServer()
    {
        $testClusterRemoveServer = new ServerInfo();
        $testClusterRemoveServer->setId(5);
        $testClusterRemoveServer->setName("www-02");
        $testClusterRemoveServer->setAddress("https://www-02.local:10082/ZendServer");
        $testClusterRemoveServer->setStatus("shuttingDown");
        $testClusterRemoveServer->setMessageList(new MessageList());
        
        self::$ClusterRemoveServerObject = $testClusterRemoveServer;
        
        return self::$ClusterRemoveServerObject; 
    }
    
    public function testLink()
    {
        $action = new \ZendService\ZendServerAPI\Method\ClusterRemoveServer();
        $action->setArgs(self::getParameter());
    
        $this->assertEquals("/Api/clusterRemoveServer", $action->getLink());
    }
    
    public function testContent()
    {
        $action = new \ZendService\ZendServerAPI\Method\ClusterRemoveServer();
        $action->setArgs(self::getParameter());
        $this->assertEquals('serverId=5&force=FALSE', $action->getContent());
    }
    
    public function testContentWithForce()
    {
        $action = new \ZendService\ZendServerAPI\Method\ClusterRemoveServer();
        $action->setArgs(self::getParameter(), true);
        $this->assertEquals('serverId=5&force=TRUE', $action->getContent());
    }
}
