<?php
namespace ZendServerAPITest\Method;

use \ZendService\ZendServerAPI\DataTypes\ServerInfo, \ZendService\ZendServerAPI\DataTypes\LicenseInfo, \ZendService\ZendServerAPI\DataTypes\MessageList, \ZendService\ZendServerAPI\DataTypes\ServersList;

/**
 * test case.
 */
class ClusterGetServerStatusTest extends \PHPUnit_Framework_TestCase
{
    public static $ClusterGetServerStatusObject = null;
    public static $ClusterGetServerStatusResponse = <<<EOF
    <zendServerAPIResponse xmlns="http://www.zend.com/server/api/1.0">
    <requestData>
        <apiKeyName>api</apiKeyName>
        <method>clusterGetServersStatus</method>
    </requestData>
    <responseData>
        <serversList>
            <serverInfo>
                <id>12</id>
                <name>www-01</name>
                <address>https://www-01.local:10082/ZendServer</address>
                <status>OK</status>
                <messageList />
            </serverInfo>
            <serverInfo>
                <id>15</id>
                <name>www-02</name>
                <address>https://www-02.local:10082/ZendServer</address>
                <status>pendingRestart</status>
                <messageList>
                    <warning>This server is waiting a PHP restart</warning>
                </messageList>
            </serverInfo>
        </serversList>
    </responseData>
</zendServerAPIResponse>
EOF;
    
    public function testParseResult()
    {
        $action = new \ZendService\ZendServerAPI\Method\ClusterGetServerStatus(self::getParameters());
        $clusterGetServerStatus = $action->parseResponse(self::$ClusterGetServerStatusResponse);

        $testClusterGetServerStatus = self::getClusterGetServerStatus();
        
        $this->assertEquals($clusterGetServerStatus, $testClusterGetServerStatus);
    }
    
    public static function getClusterGetServerStatus()
    {
        
        $testServersList = new ServersList();
        $testServerInfo1 = new ServerInfo();
        $testServerInfo2 = new ServerInfo();
        
        $testServerInfo1->setId(12);
        $testServerInfo1->setName("www-01");
        $testServerInfo1->setAddress("https://www-01.local:10082/ZendServer");
        $testServerInfo1->setStatus("OK");
        $testServerInfo1->setMessageList(new MessageList());
        
        $testServerInfo2->setId(15);
        $testServerInfo2->setName("www-02");
        $testServerInfo2->setAddress("https://www-02.local:10082/ZendServer");
        $testServerInfo2->setStatus("pendingRestart");
        $testMessageList = new MessageList();
        $testMessageList->setWarning("This server is waiting a PHP restart");
        $testServerInfo2->setMessageList($testMessageList);
        
        $testServersList->addServerInfo($testServerInfo1);
        $testServersList->addServerInfo($testServerInfo2);
        
        self::$ClusterGetServerStatusObject = $testServersList;
        
        return self::$ClusterGetServerStatusObject;
    }
    
    public static function getParameters()
    {
        return array(12,15);
    }
    
    public function testLink()
    {
        $action = new \ZendService\ZendServerAPI\Method\ClusterGetServerStatus();
        $action->setArgs(self::getParameters());
        
        $this->assertEquals("/ZendServerManager/Api/clusterGetServerStatus?servers%5B0%5D=12&servers%5B1%5D=15", $action->getLink());
    }
}

