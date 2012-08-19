<?php

use ZendServerAPI\Exception\ServerSide;


/**
 * test case.
 */
class ServerSideTest extends \PHPUnit_Framework_TestCase {

    /**
     * @expectedException \ZendServerAPI\Exception\ServerSide
     * @expectedExceptionCode 500
     * @expectedExceptionMessage serverNotLicensed: Zend Server Cluster Manager is not licensed.
     */
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
		throw new ServerSide($xml);
	}
	
}

