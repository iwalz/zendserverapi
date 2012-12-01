<?php
namespace ZendServerAPITest\Method;

use \ZendService\ZendServerAPI\Server;

use \ZendService\ZendServerAPI\DataTypes\MessageList;

use \ZendService\ZendServerAPI\Method\ClusterAddServer;
use \ZendService\ZendServerAPI\DataTypes\ServerInfo;

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
    
    public function testRequestOfAction()
    {
        $requestStub = $this->getMock('\ZendService\ZendServerAPI\Request', array('setAction', 'send'));
        $requestStub->expects($this->once())->method('setAction')->with(new ClusterAddServer(self::getServerName(), self::getServerUrl(), self::getGuiPassword()));
        $requestStub->expects($this->once())->method('send');
        
        $server = new Server("documentation");
        $request = $server->getRequest();
        $config = $request->getConfig();
        
        $requestStub->setConfig($config);
        $server->setRequest($requestStub);
        
        $server->clusterAddServer(self::getServerName(), self::getServerUrl(), self::getGuiPassword());
    }
    
    public function testContentWithDefaultSettings()
    {
        $action = new ClusterAddServer('example72', 'http://127.0.0.1:10081/ZendServer', 'foo');
        $this->assertEquals('serverName=example72&serverUrl=http://127.0.0.1:10081/ZendServer&guiPassword=foo&propagateSettings=FALSE&doRestart=FALSE', $action->getContent());
    }
    
    public function testContentWithPropagate()
    {
        $action = new ClusterAddServer('example72', 'http://127.0.0.1:10081/ZendServer', 'foo', true);
        $this->assertEquals('serverName=example72&serverUrl=http://127.0.0.1:10081/ZendServer&guiPassword=foo&propagateSettings=TRUE&doRestart=FALSE', $action->getContent());
    }
    
    public function testContentWithPropagateAndRestart()
    {
        $action = new ClusterAddServer('example72', 'http://127.0.0.1:10081/ZendServer', 'foo', true, true);
        $this->assertEquals('serverName=example72&serverUrl=http://127.0.0.1:10081/ZendServer&guiPassword=foo&propagateSettings=TRUE&doRestart=TRUE', $action->getContent());
    }

}

