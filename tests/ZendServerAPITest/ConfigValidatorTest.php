<?php

use ZendService\ZendServerAPI\Server;

use ZendService\ZendServerAPI\ServiceManagerConfig;

use \ZendService\ZendServerAPI\Startup;

class ConfigValidatorTest extends PHPUnit_Framework_TestCase
{
    public function testConfigValidatorCorrectSettings()
    {
        $configValidator = new \ZendService\ZendServerAPI\ConfigValidator(ServiceManagerConfig::getConfigFile());
        $this->assertNotEquals($configValidator->getConfig("example62"), array());
        
        $this->assertEquals($configValidator->getConfig("example62"), 
                array(
                        "version" => \ZendService\ZendServerAPI\Version::ZS56,
                        'fullApiKey'=>'49727e37c6679ecfdab2003f8e0902f75a394926b5184920d4e25b324131bd80',
                        'apiName'=>'api',
                        'host'=>'localhost',
                        'port'=>'10081',
                        'state' => \ZendService\ZendServerAPI\ApiKey::FULL,
                        'key' => '49727e37c6679ecfdab2003f8e0902f75a394926b5184920d4e25b324131bd80'
                )
        );
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Character ';' detected in API Key
     */
    public function testInvalidExceptionWithMalformedApiKey()
    {
        $configValidator = new \ZendService\ZendServerAPI\ConfigValidator(ServiceManagerConfig::getConfigFile());
        $configValidator->getConfig("example92");
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage API Key must contains 64 characters
     */
    public function testInvalidExceptionWithTooShortApiKey()
    {
        $configValidator = new \ZendService\ZendServerAPI\ConfigValidator(ServiceManagerConfig::getConfigFile());
        $configValidator->getConfig("example72");
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage host not specified in example102
     */
    public function testInvalidExceptionWithMissingHost()
    {
        $configValidator = new \ZendService\ZendServerAPI\ConfigValidator(ServiceManagerConfig::getConfigFile());
        $configValidator->getConfig("example102");
    }
    
    public function testGetSettings()
    {
        $configValidator = new \ZendService\ZendServerAPI\ConfigValidator(ServiceManagerConfig::getConfigFile());
        $settings = $configValidator->getSettings();
        
        $this->assertEquals(array('loglevel' => \Zend\Log\Logger::DEBUG), $settings);
    }
    
    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage settings section in config file is missing
     */
    public function testBrokenConfig()
    {
        $configValidator = new \ZendService\ZendServerAPI\ConfigValidator(__DIR__.'/../_files/config/brokenconfig.php');
        $settings = $configValidator->getSettings();
    }
    
    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage foo is not a valid entry for the loglevel
     */
    public function testInvalidValueConfig()
    {
        $configValidator = new \ZendService\ZendServerAPI\ConfigValidator(__DIR__.'/../_files/config/invalidvalueconfig.php');
        $settings = $configValidator->getSettings();
    }
    
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Protocol must be either http or https
     */
    public function testConfigWithErrorInProtocol()
    {
        $configValidator = new \ZendService\ZendServerAPI\ConfigValidator(ServiceManagerConfig::getConfigFile());
        $configValidator->getConfig("protocolError");
    }
    
    public function testProtocolFromDefaultHttpsPort()
    {
        
    }
    
    public function testDefaultLoglevelConfig()
    {
        $configValidator = new \ZendService\ZendServerAPI\ConfigValidator(__DIR__.'/../_files/config/testdefaultloglevelconfig.php');
        $settings = $configValidator->getSettings();
        
        $this->assertEquals(\Zend\Log\Logger::CRIT, $settings['loglevel']);
    }
    
    public function testLoglevelFilterFromConfigToRequest()
    {
        $server = new Server("example62");
        $request = $server->getRequest();
        $logger = $request->getLogger();
        $this->assertInstanceOf('\Zend\Log\Logger', $logger);
        
        $testLogger = new \Zend\Log\Logger();
        $testLogWriter = new \Zend\Log\Writer\Mock();
        $testLogger->addWriter($testLogWriter);
        
        $this->assertEquals($testLogger, $logger);
        
        $writers = $logger->getWriters();
        $writer = $writers->extract();
        $this->assertEquals($testLogWriter, $writer);
    }
    
    public function testLoglevelNegativesFromConfig()
    {
        $server = new Server("example62");
        $request = $server->getRequest();
        $logger = $request->getLogger();
        $this->assertInstanceOf('\Zend\Log\Logger', $logger);
        
        $testFilter = new \Zend\Log\Filter\Priority(\Zend\Log\Logger::WARN);
        $testLogger = new \Zend\Log\Logger();
        $testLogWriter = new \Zend\Log\Writer\Mock();
        $testLogWriter->addFilter($testFilter);
        $testLogger->addWriter($testLogWriter);
        
        $this->assertEquals($testLogger, $logger);
        
        $writers = $logger->getWriters();
        $writer = $writers->extract();
        $this->assertNotEquals($testLogWriter, $writer);
    }
}

