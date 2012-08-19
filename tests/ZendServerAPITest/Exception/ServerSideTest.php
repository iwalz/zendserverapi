<?php

use ZendServerAPI\Exception\ServerSide;

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * test case.
 */
class ServerSideTest extends PHPUnit_Framework_TestCase {

	public function testXMLParsing()
	{
		$xml = <<<EOF
<zendServerAPIResponse xmlns="http://www.zend.com/server/api/1.0">
	<requestData>
		<apiKeyName><![CDATA[api]]></apiKeyName>
		<method><![CDATA[getSystemInfo]]></method>
	</requestData>
	<errorData>
	<errorCode>serverNotLicensed</errorCode>
	<errorMessage><![CDATA[Zend Server Cluster Manager is not licensed.]]></errorMessage>
</errorData></zendServerAPIResponse>		
EOF;
		try {
			throw new ServerSide($xml);
		} catch(Exception $e)
		{
			$this->assertEquals($e->getMessage(), "serverNotLicensed: Zend Server Cluster Manager is not licensed.");
			$this->assertEquals($e->getCode(), 500);
		}
	}
	
}

