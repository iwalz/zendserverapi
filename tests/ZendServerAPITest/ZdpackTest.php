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

        $zdpack->create('skeleton', sys_get_temp_dir() . '/abcde12345');
        $this->assertTrue(is_dir(sys_get_temp_dir() . '/abcde12345'));
        $this->assertFileExists(sys_get_temp_dir() . '/abcde12345/skeleton/deployment.xml');

        $zdpack->deleteFolder(sys_get_temp_dir() . '/abcde12345');
        $this->assertFalse(is_dir(sys_get_temp_dir() . '/abcde12345'));
    }

    public function testForFunctionalPack()
    {
        $zdpack = new Zdpack;

        $zdpack->create('test', sys_get_temp_dir() . '/hijkl56789');
        $xml = simplexml_load_file(sys_get_temp_dir() . '/hijkl56789/test/deployment.xml');
        unset($xml->parameters);

        file_put_contents(sys_get_temp_dir() . '/hijkl56789/test/deployment.xml', (string)$xml->asXML());

        $zdpack->pack(sys_get_temp_dir() . '/hijkl56789/test/', '/tmp');
        $this->assertFileExists('/tmp/test.zpk');

        unlink('/tmp/test.zpk');
    }

}
