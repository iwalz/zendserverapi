<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright      Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @package        Zend_Service
 */
namespace ZendServerAPITest;

use ZendService\ZendServerAPI\Zdpack;

class ZdpackTest extends \PHPUnit_Framework_TestCase
{

    public function testForValidRecursiveDelete()
    {
        $dir = sys_get_temp_dir();
        mkdir($dir . '/zdpacktest/foo', 0755, true);
        file_put_contents($dir . '/zdpacktest/foo/test', 'test');
        $this->assertFileExists($dir . '/zdpacktest/foo/test');
        $zdpack = new Zdpack();
        $zdpack->deleteFolder($dir . '/zdpacktest');
        $this->assertFalse(is_dir($dir . '/zdpacktest'));
    }

    public function testForValidCreate()
    {
        $zdpack = new Zdpack;

        $zdpack->create('skeleton', '/tmp/data');
        $this->assertTrue(is_dir('/tmp/data'));
        $this->assertFileExists('/tmp/data/skeleton/deployment.xml');

        $zdpack->deleteFolder('/tmp/data');
        $this->assertFalse(is_dir('/tmp/data'));
    }

    public function testForFunctionalPack()
    {
        $zdpack = new Zdpack;

        $zdpack->create('test', sys_get_temp_dir());
        $xml = simplexml_load_file(sys_get_temp_dir() . '/test/deployment.xml');
        unset($xml->parameters);

        file_put_contents(sys_get_temp_dir() . '/test/deployment.xml', (string)$xml->asXML());

        $zdpack->pack(sys_get_temp_dir() . '/test/');
        $this->assertFileExists('./test.zpk');

        unlink('./test.zpk');
    }

}
