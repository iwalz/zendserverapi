<?php
namespace ZendServerAPITest\Method;

use \ZendService\ZendServerAPI\DataTypes\Step;

use \ZendService\ZendServerAPI\DataTypes\SuperGlobals;

use \ZendService\ZendServerAPI\DataTypes\Event;

use \ZendService\ZendServerAPI\DataTypes\RequestSummary;

/**
 * test case.
 */
class MonitorGetRequestSummaryTest extends \PHPUnit_Framework_TestCase
{

    public static $MonitorGetRequestSummaryObject = null;

    public static $MonitorGetRequestSummaryResponse = <<<EOF
<zendServerAPIResponse xmlns="http://www.zend.com/server/api/1.1">
    <requestData>
        <apiKeyName><![CDATA[Admin]]></apiKeyName>
        <method>monitorGetRequestSummary</method>
    </requestData>
    <responseData>
        <requestSummary>
            <eventsCount>1</eventsCount>
            <codeTracing>5.7002.1</codeTracing>
            <events>
                <event>
                    <type>PHP Error</type>
                    <description>.....</description>
                    <superGlobals>
                        <get>
                            <parameter>
                                <name>all</name>
                                <value>.....</value>
                            </parameter>
                            <parameter>
                                <name>php_warn</name>
                                <value>1</value>
                            </parameter>
                        </get>
                        <post></post>
                        <cookie>
                            <parameter>
                                <name>ZDEDebuggerPresent</name>
                                <value>.....</value>
                            </parameter>
                        </cookie>
                        <session></session>
                        <server>
                            <parameter>
                                <name>HTTP_USER_AGENT</name>
                                <value>Wget/1.12 (linux-gnu)</value>
                            </parameter>
                            <parameter>
                                <name>HTTP_ACCEPT</name>
                                <value>*/*</value>
                            </parameter>
                            <parameter>
                                <name>REQUEST_TIME</name>
                                <value>1315396868</value>
                            </parameter>
                        </server>
                    </superGlobals>
                    <debugUrl>...</debugUrl>
                    <severity>normal</severity>
                    <backtrace>
                        <step>
                            <number>0</number>
                            <object></object>
                            <class></class>
                            <function>bt_generator</function>
                            <file>/var/www/test.php</file>
                            <line>293</line>
                        </step>
                    </backtrace>
                </event>
            </events>
        </requestSummary>
    </responseData>
</zendServerAPIResponse>
EOF;
    
    public static function getParameter()
    {
        return "3AFD7433445593C54177E2A6BA60933B";
    }
    
    public static function getMonitorRequestSummary()
    {
        $monitorRequestSummary = new RequestSummary();
        $monitorRequestSummary->setEventsCount(1);
        $monitorRequestSummary->setCodeTracing("5.7002.1");
        
        $superglobals1 = new SuperGlobals();
        $superglobals1->addGetParameter("all", ".....");
        $superglobals1->addGetParameter("php_warn", "1");
        $superglobals1->addCookieParameter("ZDEDebuggerPresent", ".....");
        $superglobals1->addServerParameter("HTTP_USER_AGENT", "Wget/1.12 (linux-gnu)");
        $superglobals1->addServerParameter("HTTP_ACCEPT", "*/*");
        $superglobals1->addServerParameter("REQUEST_TIME", "1315396868");
        
        $event1 = new Event();
        $event1->setType("PHP Error");
        $event1->setDescription(".....");
        $event1->setSuperglobals($superglobals1);
        $event1->setSeverity("normal");
        $event1->setDebugUrl("...");
        
        $step1 = new Step();
        $step1->setNumber("0");
        $step1->setObject('');
        $step1->setClass('');
        $step1->setFunction('bt_generator');
        $step1->setFile('/var/www/test.php');
        $step1->setLine('293');
        
        $event1->addStep($step1);
        
        $monitorRequestSummary->addEvents($event1);
        
        self::$MonitorGetRequestSummaryObject = $monitorRequestSummary;
        
        return self::$MonitorGetRequestSummaryObject;
    }
}

