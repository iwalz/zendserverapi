<?php
namespace ZendServerAPITest;

use ZendServerAPI\DataTypes\ServersList;

use ZendServerAPI\Method\RestartPHP;

/**
 * test case.
 */
class RestartPHPTest extends \PHPUnit_Framework_TestCase
{
    public static $RestartPHPObject = null;
    public static $RestartPHPResponse = <<<EOF
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
        $action = new RestartPHP();
        $restartPHP = $action->parseResponse(self::$RestartPHPResponse);
        
        $testRestartPHP = new ServersList();
        
        self::$RestartPHPObject = $testRestartPHP;
    }
}
