<?php
namespace ZendServerAPITest;

use \ZendService\ZendServerAPI\Exception\ClientSide;

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
     * @expectedException \ZendService\ZendServerAPI\Exception\ClientSide
     * @expectedExceptionCode 400
     * @expectedExceptionMessage authError: Incorrect signature 
     */
	public function testXMLParsing()
	{
		throw new ClientSide(self::$Response);
	}

	/**
	 * @expectedException \ZendService\ZendServerAPI\Exception\ClientSide
	 * @expectedExceptionCode 400    
	 * @expectedExceptionMessage missingParameter: This action requires the baseUrl parameter
	 */
	public function testExceptionParsingAgainstProduction()
	{
	    $deployment = new \ZendService\ZendServerAPI\Deployment("example62");
// 	    var_dump($deployment->getServiceManager());die;
        
// 	    if(!$deployment->canConnect())
// 	        $this->markTestSkipped();
        $deployment->applicationDeploy(__DIR__.'/../../_files/example1.zpk', null);
	}
	
}

