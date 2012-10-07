<?php

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * test case.
 */
class EventsGroupDetailAdapterTest extends PHPUnit_Framework_TestCase
{
    private static $response =<<<EOF

EOF;
    
    /**
     * Constructs the test case.
     */
    public function testEventsGroupDetailAdapter()
    {
        $eventsGroupDetails = new \ZendServerAPI\Adapter\EventsGroupDetails();
        $result = $eventsGroupDetails->parse(file_get_contents(__DIR__.'/TestAssets/eventsGroupDetail.xml'));
        
        $this->assertInstanceOf('\ZendServerAPI\DataTypes\EventsGroupDetails', $result);
        
        $this->assertEquals("72", $result->getIssueId());
        
        $expectedEventsGroup = new \ZendServerAPI\DataTypes\EventsGroup();
        $expectedEventsGroup->setEventsGroupId(101);
        $expectedEventsGroup->setEventsCount(1);
        $expectedEventsGroup->setStartTime("22-Jul-2012 19:15");
        $expectedEventsGroup->setServerId(0);
        $expectedEventsGroup->setClass("");
        $expectedEventsGroup->setUserData("");
        $expectedEventsGroup->setJavaBacktrace("");
        $expectedEventsGroup->setExecTime(0);
        $expectedEventsGroup->setAvgExecTime(0);
        $expectedEventsGroup->setMemUsage(0);
        $expectedEventsGroup->setAvgMemUsage(0);
        $expectedEventsGroup->setAvgOutputSize(0);
        $expectedEventsGroup->setLoad(0);
        
        $this->assertEquals($expectedEventsGroup, $result->getEventsGroup());
        
        $expectedEvent = new \ZendServerAPI\DataTypes\Event();
        $expectedEvent->setType('8');
        $expectedEvent->setDescription("Fatal PHP Error");
        $expectedEvent->setEventsGroupId('101');
        $expectedEvent->setSeverity('Critical>');
        
        $expectedSuperglobals = new \ZendServerAPI\DataTypes\SuperGlobals();
        $expectedSuperglobals->addCookieParameter("ZDEDebuggerPresent", "php,phtml,php3");
        $expectedSuperglobals->addServerParameter("HTTP_HOST", "hp.local");
        $expectedSuperglobals->addServerParameter("HTTP_USER_AGENT", "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:14.0) Gecko/20100101 Firefox/14.0.1");
        $expectedSuperglobals->addServerParameter("HTTP_ACCEPT", "text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8");
        $expectedSuperglobals->addServerParameter("HTTP_ACCEPT_LANGUAGE", "de-de,de;q=0.8,en-us;q=0.5,en;q=0.3");
        $expectedSuperglobals->addServerParameter("HTTP_ACCEPT_ENCODING", "gzip, deflate");
        $expectedSuperglobals->addServerParameter("HTTP_CONNECTION", "keep-alive");
        $expectedSuperglobals->addServerParameter("HTTP_COOKIE", "ZDEDebuggerPresent=php,phtml,php3");
        $expectedSuperglobals->addServerParameter("HTTP_CACHE_CONTROL", "max-age=0");
        $expectedSuperglobals->addServerParameter("PATH", "/usr/local/bin:/usr/bin:/bin");
        $expectedSuperglobals->addServerParameter("SERVER_SIGNATURE", "<address>Apache/2.2.22 (Ubuntu) Server at hp.local Port 80</address>");
        $expectedSuperglobals->addServerParameter("SERVER_SOFTWARE", "Apache/2.2.22 (Ubuntu)");
        $expectedSuperglobals->addServerParameter("SERVER_NAME", "hp.local");
        $expectedSuperglobals->addServerParameter("SERVER_ADDR", "127.0.0.1");
        $expectedSuperglobals->addServerParameter("SERVER_PORT", "80");
        $expectedSuperglobals->addServerParameter("REMOTE_ADDR", "127.0.0.1");
        $expectedSuperglobals->addServerParameter("DOCUMENT_ROOT", "/var/www/website/public/");
        $expectedSuperglobals->addServerParameter("SERVER_ADMIN", "[no address given]");
        $expectedSuperglobals->addServerParameter("SCRIPT_FILENAME", "/var/www/website/public/index.php");
        $expectedSuperglobals->addServerParameter("REMOTE_PORT", "52000");
        $expectedSuperglobals->addServerParameter("GATEWAY_INTERFACE", "CGI/1.1");
        $expectedSuperglobals->addServerParameter("SERVER_PROTOCOL", "HTTP/1.1");
        $expectedSuperglobals->addServerParameter("REQUEST_METHOD", "GET");
        $expectedSuperglobals->addServerParameter("QUERY_STRING", "");
        $expectedSuperglobals->addServerParameter("REQUEST_URI", "/");
        $expectedSuperglobals->addServerParameter("SCRIPT_NAME", "/index.php");
        $expectedSuperglobals->addServerParameter("PHP_SELF", "/index.php");
        $expectedSuperglobals->addServerParameter("REQUEST_TIME", "1342977302");
        
        $expectedEvent->setSuperglobals($expectedSuperglobals);
        
        $expectedStep = new \ZendServerAPI\DataTypes\Step();
        $expectedStep->setClass('Application\Controller\IndexController');
        $expectedStep->setFile('/var/www/website/module/Application/src/Application/Controller/IndexController.php');
        $expectedStep->setFunction('indexAction');
        $expectedStep->setLine('67');
        $expectedStep->setObject('Application\Controller\IndexController');
        $expectedStep->setNumber('1');
        $expectedEvent->addStep($expectedStep);
        
        $expectedStep = new \ZendServerAPI\DataTypes\Step();
        $expectedStep->setClass('Zend\Mvc\Controller\AbstractActionController');
        $expectedStep->setFile('/var/www/website/vendor/zendframework/zendframework/library/Zend/Mvc/Controller/AbstractActionController.php');
        $expectedStep->setFunction('execute');
        $expectedStep->setLine('137');
        $expectedStep->setObject('Application\Controller\IndexController');
        $expectedStep->setNumber('2');
        $expectedEvent->addStep($expectedStep);
        
        $expectedStep = new \ZendServerAPI\DataTypes\Step();
        $expectedStep->setClass('Zend\Mvc\Controller\AbstractActionController');
        $expectedStep->setFile('');
        $expectedStep->setFunction('execute');
        $expectedStep->setLine('0');
        $expectedStep->setObject('Application\Controller\IndexController');
        $expectedStep->setNumber('3');
        $expectedEvent->addStep($expectedStep);
        
        $expectedStep = new \ZendServerAPI\DataTypes\Step();
        $expectedStep->setClass('Zend\EventManager\EventManager');
        $expectedStep->setFile('/var/www/website/vendor/zendframework/zendframework/library/Zend/EventManager/EventManager.php');
        $expectedStep->setFunction('Zend\EventManager\EventManager::triggerListeners');
        $expectedStep->setLine('453');
        $expectedStep->setObject('');
        $expectedStep->setNumber('4');
        $expectedEvent->addStep($expectedStep);
        
        $this->assertEquals($expectedEvent, $result->getEvent());
    }
}

