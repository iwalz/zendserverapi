<?php

use ZendServerAPI\Exception\ServerSide;


/**
 * test case.
 */
class ServerSideTest extends \PHPUnit_Framework_TestCase {

    public static $Response = <<<EOF
            <zendServerAPIResponse xmlns="http://www.zend.com/server/api/1.0">
	            <requestData>
		            <apiKeyName><![CDATA[api]]></apiKeyName>
		            <method><![CDATA[getSystemInfo]]></method>
	            </requestData>
	            <errorData>
	                <errorCode>serverNotLicensed</errorCode>
	                <errorMessage><![CDATA[Zend Server Cluster Manager is not licensed.]]></errorMessage>
                </errorData>
		    </zendServerAPIResponse>		
EOF;
    
    /**
     * @expectedException \ZendServerAPI\Exception\ServerSide
     * @expectedExceptionCode 500
     * @expectedExceptionMessage serverNotLicensed: Zend Server Cluster Manager is not licensed.
     */
	public function testXMLParsing()
	{
		throw new ServerSide(self::$Response);
	}
}

