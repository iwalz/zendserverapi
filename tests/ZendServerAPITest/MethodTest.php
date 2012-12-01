<?php
namespace ZendServerAPITest;

/**
 * test case.
 */
class MethodTest extends \PHPUnit_Framework_TestCase
{
    private $methodMock = null;
    
    public function __construct ()
    {
        $this->methodMock = $this->getMockForAbstractClass('\ZendService\ZendServerAPI\Method\Method');
    }
    
    public function testBuildParameter()
    {
        $values = array('foo', 'bar');
        $index = 'blubb';
        
        $result = $this->methodMock->buildParameterArray($index, $values);
        $this->assertEquals('blubb%5B0%5D=foo&blubb%5B1%5D=bar', $result);
    }
}

