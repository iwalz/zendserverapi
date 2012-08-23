<?php
namespace ZendServerAPITest;

/**
 * test case.
 */
class RequestTest extends \PHPUnit_Framework_TestCase {

    private $apiKey = null;
    private $config = null;
    
    public function setUp()
    {
        $this->apiKey = new \ZendServerAPI\ApiKey();
        $this->apiKey->setName('api');
        $this->apiKey->setKey('058b82f191d934a7bfe17d12060dd3320869f132d3428fa19d35463903673eee');
        $this->apiKey->setState(\ZendServerAPI\ApiKey::FULL);
        
        $this->config = new \ZendServerAPI\Config;
        $this->config->setHost('127.0.0.1');
        $this->config->setApiKey($this->apiKey);
    }
    
	public function testRequest()
	{
	    $request = new \ZendServerAPI\Request();
		$request->setConfig($this->config);
		$this->assertInstanceOf('\ZendServerAPI\ApiKey', $request->getConfig()->getApiKey());
		$this->assertSame('api', $request->getConfig()->getApiKey()->getName());
		$this->assertSame('058b82f191d934a7bfe17d12060dd3320869f132d3428fa19d35463903673eee', $request->getConfig()->getApiKey()->getKey());
		$this->assertEquals(\ZendServerAPI\ApiKey::FULL, $request->getConfig()->getApiKey()->getState());
	}
}

