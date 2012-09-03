<?php
namespace ZendServerAPITest;
use ZendServerAPI\Exception\ClientSide;

/**
 * test case.
 */
class ClientSideTest extends \PHPUnit_Framework_TestCase {

	public static $Response = <<<EOF
            <zendServerAPIResponse xmlns="http://www.zend.com/server/api/1.0">
	            <requestData>
		            <apiKeyName><![CDATA[api]]></apiKeyName>
		            <method><![CDATA[getSystemInfo]]></method>
	            </requestData>
	            <errorData>
	                <errorCode>authError</errorCode>
	                <errorMessage><![CDATA[Incorrect signature]]></errorMessage>
                </errorData>
            </zendServerAPIResponse>
EOF;
 
    /**
     * @expectedException \ZendServerAPI\Exception\ClientSide
     * @expectedExceptionCode 400
     * @expectedExceptionMessage authError: Incorrect signature 
     */
	public function testXMLParsing()
	{
		throw new ClientSide(self::$Response);
	}
	
	
}

