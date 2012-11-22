<?php

use ZendServerAPI\Startup;

class ConfigValidatorTest extends PHPUnit_Framework_TestCase
{
    public function testConfigValidatorCorrectSettings()
    {
        $configValidator = new \ZendServerAPI\ConfigValidator(Startup::getConfigPath());
        $this->assertNotEquals($configValidator->getConfig("example62"), array());
        
        $this->assertEquals($configValidator->getConfig("example62"), 
                array(
                        "version" => \ZendServerAPI\Version::ZS56,
                        'fullApiKey'=>'49727e37c6679ecfdab2003f8e0902f75a394926b5184920d4e25b324131bd80',
                        'apiName'=>'api',
                        'host'=>'localhost',
                        'port'=>'10081',
                        'state' => \ZendServerAPI\ApiKey::FULL,
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
        $configValidator = new \ZendServerAPI\ConfigValidator(Startup::getConfigPath());
        $configValidator->getConfig("example92");
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage API Key must contains 64 characters
     */
    public function testInvalidExceptionWithTooShortApiKey()
    {
        $configValidator = new \ZendServerAPI\ConfigValidator(Startup::getConfigPath());
        $configValidator->getConfig("example72");
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage host not specified in example102
     */
    public function testInvalidExceptionWithMissingHost()
    {
        $configValidator = new \ZendServerAPI\ConfigValidator(Startup::getConfigPath());
        $configValidator->getConfig("example102");
    }
    
    public function testGetSettings()
    {
        $configValidator = new \ZendServerAPI\ConfigValidator(Startup::getConfigPath());
        $settings = $configValidator->getSettings();
        
        $this->assertEquals(array('loglevel' => \Zend\Log\Logger::DEBUG), $settings);
    }
    
    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage settings section in config file is missing
     */
    public function testBrokenConfig()
    {
        $configValidator = new \ZendServerAPI\ConfigValidator(__DIR__.'/../_files/config/brokenconfig.php');
        $settings = $configValidator->getSettings();
    }
    
    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage foo is not a valid entry for the loglevel
     */
    public function testInvalidValueConfig()
    {
        $configValidator = new \ZendServerAPI\ConfigValidator(__DIR__.'/../_files/config/invalidvalueconfig.php');
        $settings = $configValidator->getSettings();
    }
    
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Protocol must be either http or https
     */
    public function testConfigWithErrorInProtocol()
    {
        $request = \ZendServerAPI\Startup::getRequest("protocolError");
    }
    
    public function testProtocolFromDefaultHttpsPort()
    {
        
    }
    
    public function testDefaultLoglevelConfig()
    {
        $configValidator = new \ZendServerAPI\ConfigValidator(__DIR__.'/../_files/config/testdefaultloglevelconfig.php');
        $settings = $configValidator->getSettings();
        
        $this->assertEquals(\Zend\Log\Logger::CRIT, $settings['loglevel']);
    }
    
    public function testLoglevelFilterFromConfigToRequest()
    {
        $request = Startup::getRequest("example62");
        $logger = $request->getLogger();
        $this->assertInstanceOf('\Zend\Log\Logger', $logger);
        
        $testFilter = new \Zend\Log\Filter\Priority(\Zend\Log\Logger::DEBUG);
        $testLogger = new \Zend\Log\Logger();
        $testLogWriter = new \Zend\Log\Writer\Mock();
        $testLogWriter->addFilter($testFilter);
        $testLogger->addWriter($testLogWriter);
        
        $this->assertEquals($testLogger, $logger);
        
        $writers = $logger->getWriters();
        $writer = $writers->extract();
        $this->assertEquals($testLogWriter, $writer);
    }
    
    public function testLoglevelNegativesFromConfig()
    {
        $request = Startup::getRequest("example62");
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

