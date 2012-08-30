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
                        'clusterManager' => '1',
                        'fullApiKey'=>'058b82f191d934a7bfe17d12060dd3320869f132d3428fa19d35463903673eee',
                        'apiName'=>'apikey',
                        'host'=>'10.0.1.72',
                        'port'=>'10081',
                        'state' => \ZendServerAPI\ApiKey::FULL,
                        'key' => '058b82f191d934a7bfe17d12060dd3320869f132d3428fa19d35463903673eee'
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
}

