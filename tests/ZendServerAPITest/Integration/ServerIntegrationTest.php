<?php

namespace ZendServerAPITest\Integration;

use ZendService\ZendServerAPI\DataTypes\ServerInfo;
use ZendService\ZendServerAPI\DataTypes\MessageList;
use ZendService\ZendServerAPI\DataTypes\LicenseInfo;
use ZendService\ZendServerAPI\DataTypes\SystemInfo;
use ZendService\ZendServerAPI\DataTypes\ServersList;

class ServerIntegrationTest extends \ZendServerAPITest\Integration\BaseAPIIntegration
{
    public function setUp() 
    {
        $this->mockObject = new \ZendService\ZendServerAPI\Server();
        $this->object = new \ZendService\ZendServerAPI\Server(self::LOCAL);
        parent::setUp();
    }
    
    public function getSystemInfo()
    {
        $systemInfo = new SystemInfo();
        
        $systemInfo->setStatus("OK");
        $systemInfo->setEdition("ZendServer");
        $systemInfo->setZendServerVersion("5.6.0");
        $systemInfo->setSupportedApiVersions("application/vnd.zend.serverapi+xml;version=1.0,
                                application/vnd.zend.serverapi+xml;version=1.1,
                                application/vnd.zend.serverapi+xml;version=1.2");
        $systemInfo->setPhpVersion("5.3.14");
        $systemInfo->setOperatingSystem("Linux");
        $systemInfo->setDeploymentVersion("1.0");

        $serverLicenseInfo = new LicenseInfo();
        $serverLicenseInfo->setStatus("OK");
        $serverLicenseInfo->setOrderNumber("GR-00280-12");
        $serverLicenseInfo->setValidUntil('Do., 14 Nov 2013 23:00:00 GMT');
        $serverLicenseInfo->setServerLimit(0);
        $systemInfo->setServerLicenseInfo($serverLicenseInfo);
        
        $managerLicenseInfo = new LicenseInfo();
        $managerLicenseInfo->setStatus("notRequired");
        $managerLicenseInfo->setOrderNumber("");
        $managerLicenseInfo->setValidUntil('');
        $managerLicenseInfo->setServerLimit(0);
        $systemInfo->setManagerLicenseInfo($managerLicenseInfo);
        
        $systemInfo->setMessageList(new MessageList());
        return $systemInfo;
    }
    
    public function getClusterGetServerStatus()
    {
        $serversList = new ServersList();

        $serverInfo = new ServerInfo();
        $serverInfo->setAddress('http://192.168.2.4:10081/ZendServer');
        $serverInfo->setName('zendserver2');
        $serverInfo->setId(54);
        $serverInfo->setMessageList(new MessageList());
        $serverInfo->setStatus('OK');
        
        $serversList->addServerInfo($serverInfo);
        
        return $serversList;
    }
    
    public function getClusterEnableServer()
    {
        $serverInfo = new ServerInfo();
        $serverInfo->setAddress('http://192.168.2.4:10081/ZendServer');
        $serverInfo->setStatus('pendingRestart');
        $serverInfo->setId(55);
        $serverInfo->setName('zendserver2');
        
        $messageList = new MessageList();
        $messageList->setInfo("This server's PHP needs to be restarted");
        $serverInfo->setMessageList($messageList);
        
        return $serverInfo;
    }
    
    public function getClusterDisableServer()
    {
        $serverInfo = new ServerInfo();
        $serverInfo->setAddress('http://192.168.2.4:10081/ZendServer');
        $serverInfo->setStatus('disabled');
        $serverInfo->setId(55);
        $serverInfo->setName('zendserver2');
    
        $messageList = new MessageList();
        $messageList->setInfo("This server is disabled");
        $serverInfo->setMessageList($messageList);
    
        return $serverInfo;
    }
    
    public function getClusterRemoveServer()
    {
        $serverInfo = new ServerInfo();
        $serverInfo->setAddress('http://192.168.2.4:10081/ZendServer');
        $serverInfo->setStatus('removed');
        $serverInfo->setId(54);
        $serverInfo->setName('zendserver2');
    
        $messageList = new MessageList();
        $serverInfo->setMessageList($messageList);
    
        return $serverInfo;
    }
    
    public function getRestartPhp()
    {
        $serversList = new ServersList();
    
        $serverInfo = new ServerInfo();
        $serverInfo->setAddress('http://192.168.2.4:10081/ZendServer');
        $serverInfo->setName('zendserver2');
        $serverInfo->setId(55);
        $serverInfo->setMessageList(new MessageList());
        $serverInfo->setStatus('restarting');
    
        $serversList->addServerInfo($serverInfo);
    
        return $serversList;
    }
    
    public function getClusterAddServer()
    {
        $serverInfo = new ServerInfo();
        $serverInfo->setAddress('http://192.168.2.4:10081/ZendServer');
        $serverInfo->setStatus('OK');
        $serverInfo->setId(55);
        $serverInfo->setName('zendserver2');
    
        $messageList = new MessageList();
        $serverInfo->setMessageList($messageList);
    
        return $serverInfo;
    }
    
    public function getClusterReconfigureServer()
    {
        $serverInfo = new ServerInfo();
        $serverInfo->setAddress('http://192.168.2.4:10081/ZendServer');
        $serverInfo->setStatus('pendingRestart');
        $serverInfo->setId(55);
        $serverInfo->setName('zendserver2');
    
        $messageList = new MessageList();
        $messageList->setInfo("This server's PHP needs to be restarted");
        $serverInfo->setMessageList($messageList);
    
        return $serverInfo;
    }
    
    public function mockProvider()
    {
        static::$mockDataProvider = array(
            array("getSystemInfo", $this->getSystemInfo(), array()),
            array("clusterGetServerStatus", $this->getClusterGetServerStatus(), array()),
            array("clusterEnableServer", $this->getClusterEnableServer(), array(55)),
            array("clusterDisableServer", $this->getClusterDisableServer(), array(55)),
            array("clusterRemoveServer", $this->getClusterRemoveServer(), array(54)),
            array("restartPhp", $this->getRestartPhp(), array(array(55))),
            array("clusterReconfigureServer", $this->getClusterReconfigureServer(), array(55)),
            array("clusterAddServer", $this->getClusterAddServer(), array('zendserver2', 'http://192.168.2.4:10081/ZendServer', 'test', false, true))
        );
                 
        return static::$mockDataProvider;
    }   
    
    public function productionProvider()
    {
        static::$localDataProvider = array(
                array("getSystemInfo", array(), self::LOCAL),
                array("restartPhp", array(), self::LOCAL)
        );
         
        return static::$localDataProvider;
    }

    public function getSection()
    {
        return "server";
    }
}

