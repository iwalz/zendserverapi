<?php
namespace ZendServerAPITest;

/**
 * test case.
 */
class ApplicationDeployTest extends \PHPUnit_Framework_TestCase
{
    public function testApplicationdeploy()
    {
        $applicationDeploy = new \ZendServerAPI\Method\ApplicationDeploy(
            new \SplFileInfo('../../_files/example1.zpk'), 
            'http://www.test.com',
            true,
            false,
            'Example Application',
            false,
            array(
                'foo' => 'bar'        
            )
        );
        
        $this->assertEquals(new \SplFileInfo('../../_files/example1.zpk'), $applicationDeploy->getAppPackage());
        $this->assertEquals('http://www.test.com', $applicationDeploy->getBaseUrl());
        $this->assertTrue($applicationDeploy->getCreateVhost());
        $this->assertFalse($applicationDeploy->getDefaultServer());
        $this->assertEquals('Example Application', $applicationDeploy->getUserAppName());
        $this->assertFalse($applicationDeploy->getIgnoreFailures());
        $this->assertEquals(array('foo' => 'bar'), $applicationDeploy->getUserParams());
    }
}

