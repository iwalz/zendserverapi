<?php

use ZendServerAPI\Exception\ClientSide;

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * test case.
 */
class ClientSideTest extends PHPUnit_Framework_TestCase {

	public function testXMLParsing()
	{
		$xml = <<<EOF
<zendServerAPIResponse xmlns="http://www.zend.com/server/api/1.0">
	<requestData>
		<apiKeyName><![CDATA[api]]></apiKeyName>
		<method><![CDATA[getSystemInfo]]></method>
	</requestData>
	<errorData>
	<errorCode>authError</errorCode>
	<errorMessage><![CDATA[Incorrect signature]]></errorMessage>
</errorData></zendServerAPIResponse>		
EOF;
		try {
			throw new ClientSide($xml);
		} catch(Exception $e)
		{
			$this->assertEquals($e->getMessage(), "authError: Incorrect signature");
			$this->assertEquals($e->getCode(), 400);
		}
	}
	
}

