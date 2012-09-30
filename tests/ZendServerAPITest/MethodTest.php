<?php
namespace ZendServerAPITest;

/**
 * test case.
 */
class MethodTest extends \PHPUnit_Framework_TestCase
{
    private $methodMock = null;
    
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        parent::setUp();
        
        // TODO Auto-generated MethodTest::setUp()
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        // TODO Auto-generated MethodTest::tearDown()
        parent::tearDown();
    }

    public function __construct ()
    {
        $this->methodMock = $this->getMockForAbstractClass('\ZendServerAPI\Method');
        // TODO Auto-generated constructor
    }
    
    public function testBuildParameter()
    {
        $values = array('foo', 'bar');
        $index = 'blubb';
        
        $result = $this->methodMock->buildParameterArray($index, $values);
        $this->assertEquals('blubb%5B0%5D=foo&blubb%5B1%5D=bar', $result);
    }
}

