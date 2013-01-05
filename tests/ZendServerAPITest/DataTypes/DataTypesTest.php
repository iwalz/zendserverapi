<?php
namespace ZendServerAPITest;

class DataTypesTest extends \PHPUnit_Framework_TestCase
{
    public function testClassHydratorOnDataTypes()
    {
        $hydrator = new \Zend\Stdlib\Hydrator\ClassMethods();
        $applicationInfo = new \ZendService\ZendServerAPI\DataTypes\ApplicationInfo();

        #var_dump($hydrator->extract($applicationInfo));
    }
}
