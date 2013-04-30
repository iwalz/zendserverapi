<?php
namespace ZendServerAPITest\Method;

use \ZendService\ZendServerAPI\Method\MonitorGetRequestSummary;

use \ZendService\ZendServerAPI\Method\GetSystemInfo,
    \ZendService\ZendServerAPI\Method\ClusterAddServer,
    \ZendService\ZendServerAPI\Method\ClusterRemoveServer,
    \ZendService\ZendServerAPI\Method\ClusterGetServerStatus,
    \ZendService\ZendServerAPI\Method\ClusterReconfigureServer,
    \ZendService\ZendServerAPI\Method\RestartPHP,
    \ZendService\ZendServerAPI\Method\ClusterEnableServer,
    \ZendService\ZendServerAPI\Method\ClusterDisableServer;


/**
 * test case.
 */
class MethodImplementationTest extends \PHPUnit_Framework_TestCase {
	
	public function testGetSystemInfoMethod()
	{
		$implementation = $this->getMock('\ZendService\ZendServerAPI\Method\GetSystemInfo', array('setMethod', 'setFunctionPath'));
		$implementation->expects($this->once())->method('setMethod')->with('GET');
		$implementation->expects($this->once())->method('setFunctionPath')->with('/Api/getSystemInfo');
		
		$implementation->configure();
	}
	
	public function testClusterGetServerStatus()
	{
	    $implementation = $this->getMock('\ZendService\ZendServerAPI\Method\ClusterGetServerStatus', array('setMethod', 'setFunctionPath'), array(ClusterGetServerStatusTest::getParameters()));
	    $implementation->expects($this->once())->method('setMethod')->with('GET');
	    $implementation->expects($this->once())->method('setFunctionPath')->with('/Api/clusterGetServerStatus');
	
	    $implementation->configure();
	}
	
	public function testRestartPHP()
	{
	    $implementation = $this->getMock('\ZendService\ZendServerAPI\Method\RestartPHP', array('setMethod', 'setFunctionPath'));
	    $implementation->expects($this->once())->method('setMethod')->with('POST');
	    $implementation->expects($this->once())->method('setFunctionPath')->with('/Api/restartPhp');
	    
	    $implementation->configure();
	}
	
	/**
	 * @dataProvider provider
	 */
	public function testMethods($action, $xml, $model)
	{
	    $this->assertEquals($action->parseResponse($xml), $model);
	}
	
	public function provider()
	{
	    return array(
	            array(
	                    new GetSystemInfo(),
	                    GetSystemInfoTest::$GetSystemInfoResponse,
	                    GetSystemInfoTest::getSystemInfo()
	            ),
	            array(
	                    new ClusterGetServerStatus(ClusterGetServerStatusTest::getParameters()),
	                    ClusterGetServerStatusTest::$ClusterGetServerStatusResponse,
	                    ClusterGetServerStatusTest::getClusterGetServerStatus(),
	            ),
	            array(
	                    new ClusterDisableServer(ClusterDisableServerTest::getParameter()),
	                    ClusterDisableServerTest::$ClusterDisableServerResponse,
	                    ClusterDisableServerTest::getClusterDisableServer(),
	            ),
	            array(
	                    new ClusterRemoveServer(ClusterRemoveServerTest::getParameter()),
	                    ClusterRemoveServerTest::$ClusterRemoveServerResponse,
	                    ClusterRemoveServerTest::getClusterRemoveServer(),
	            ),
	            array(
	                    new ClusterAddServer(ClusterAddServerTest::getServerName(), ClusterAddServerTest::getServerUrl(), ClusterAddServerTest::getGuiPassword()),
	                    ClusterAddServerTest::$ClusterAddServerResponse,
	                    ClusterAddServerTest::getAddServerObject(),
	            ),
	            array(
	                    new ClusterReconfigureServer(ClusterReconfigureServerTest::getParameter()),
	                    ClusterReconfigureServerTest::$ClusterReconfigureServerResponse,
	                    ClusterReconfigureServerTest::getClusterReconfigureServer(),
	            ),
	            array(
	                    new ClusterEnableServer(ClusterEnableServerTest::getParameter()),
	                    ClusterEnableServerTest::$ClusterEnableServerResponse,
	                    ClusterEnableServerTest::getClusterEnableServer(),
	            ),
	            array(
	                    new MonitorGetRequestSummary(MonitorGetRequestSummaryTest::getParameter()),
                        MonitorGetRequestSummaryTest::$MonitorGetRequestSummaryResponse,
                        MonitorGetRequestSummaryTest::getMonitorRequestSummary(),
                )
	    );
	}
}

