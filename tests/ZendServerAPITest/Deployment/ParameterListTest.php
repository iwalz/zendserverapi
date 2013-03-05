<?php
namespace ZendServerAPITest;
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright      Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @package        Zend_Service
 */

use PHPUnit_Framework_TestCase;
use ZendService\ZendServerAPI\Deployment\ParameterList;
use ZendService\ZendServerAPI\Deployment\Parameter;

class ParameterListTest extends PHPUnit_Framework_TestCase
{
    public function testValidAdd()
    {
        $parameterList = new ParameterList();
        $parameter = new Parameter();
        $this->assertEquals(0, count($parameterList));
        $parameterList->addParameter($parameter);
        $this->assertEquals(1, count($parameterList));

        foreach($parameterList as $param) {
            $this->assertSame($parameter, $param);
        }
    }
}
