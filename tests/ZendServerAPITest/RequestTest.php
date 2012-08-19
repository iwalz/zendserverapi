<?php
namespace ZendServerAPITest;

/**
 * test case.
 */
class RequestTest extends \PHPUnit_Framework_TestCase {
	
	public function testRequest()
	{
	    $request = new \ZendServerAPI\Request();
		$request->setConfig(\ZendServerAPITest\Container::getConfig());
		$this->assertInstanceOf('\ZendServerAPI\ApiKey', $request->getConfig()->getApiKey());
		$this->assertSame('api', $request->getConfig()->getApiKey()->getName());
		$this->assertSame('058b82f191d934a7bfe17d12060dd3320869f132d3428fa19d35463903673eee', $request->getConfig()->getApiKey()->getKey());
		$this->assertEquals(\ZendServerAPI\ApiKey::FULL, $request->getConfig()->getApiKey()->getState());
	}
}

