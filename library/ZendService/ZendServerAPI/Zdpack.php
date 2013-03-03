<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright      Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @package        Zend_Service
 */
namespace ZendService\ZendServerAPI;

use ZendService\ZendServerAPI\PluginInterface;

/**
 * <b>zdpack</b>
 *
 * Provides the basic zdpack tasks create and pack without the need of zdpack binary.
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class Zdpack implements PluginInterface
{
    /**
     * Executes the shell command
     *
     *   cd $directory;
     *   zdpack create $name
     *
     * @param string $name The name of the project
     * @param string|null $directory The path to the directory, where to generate subdirectory $name
     */
    public function create($name, $directory = null)
    {
        if (!is_dir($directory)) {
            $isDirCreated = mkdir($directory, 0755, true);
            if (!$isDirCreated) {
                throw new \InvalidArgumentException("Can't create directory: $directory");
            }
        }
        $destDir = realpath($directory) . '/' . $name;

        $this->copyFolder(__DIR__ . '/Zdpack/Assets/', $destDir);
        $deploymentXml = realpath($destDir) . '/deployment.xml';

        if (is_file($deploymentXml)) {
            $xml = simplexml_load_file($deploymentXml);
            $xml->name = $name;
            file_put_contents($deploymentXml, (string) $xml->asXML());
        }
    }

    /**
     * Similar to the shell command
     *
     *   cd $directory;
     *   zdpack create $name
     *
     * zdpack does not need to be installed
     *
     * @param string $name The name of the project
     * @param string|null $directory The path to the directory, where to generate subdirectory $name
     * @return \SplFileInfo
     */
    public function pack($path, $saveTo = null)
    {
        if (extension_loaded('zip')) {
            $path = realpath($path);
            $deploymentXml = simplexml_load_file($path . '/deployment.xml');
            $name = '';

            if ($saveTo !== null) {
                $name .= realpath($saveTo) . '/';
            }
            $name .= (string) $deploymentXml->name . '.zpk';
            $zip = new \ZipArchive();
            $zip->open($name, \ZipArchive::CREATE);

            $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($path),
                \RecursiveIteratorIterator::SELF_FIRST
            );

            foreach($iterator as $entry) {
                $entries = explode(DIRECTORY_SEPARATOR, $entry);
                $lastElement = array_pop($entries);
                if ($lastElement == '.' || $lastElement == '..') {
                    continue;
                }
                if ($entry->isDir()) {
                    $zip->addEmptyDir(str_replace($path.'/', "", $entry));
                }
                elseif ($entry->isFile()) {
                    $zip->addFile(realpath($entry), str_replace($path.'/', "", $entry));
                }
            }

            $zip->close();

            return new \SplFileInfo($name);
        } else {
            throw new \RuntimeException("Zip extension needs to be loaded");
        }
    }

    /**
     * Delete folder recursively - take care!
     *
     * @param string $dir Folder to delete
     * @param array $excludeDirNames
     * @param array $excludeFileNames
     * @return void
     */
    public function deleteFolder($dir, $excludeDirNames = array(), $excludeFileNames = array())
    {
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($dir),
            \RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach($iterator as $entry) {
            if (substr($entry, -1) == '.') {
                continue;
            }
            if (substr($entry, -2) == '..') {
                continue;
            }
            if ($entry->isDir()) {
                if (!in_array($entry->getBasename(), $excludeDirNames)) {
                    try {
                        rmdir($entry->getPathname());
                    }
                    catch (\Exception $ex) {
                        // dir not empty
                    }
                }
            }
            elseif (!in_array($entry->getFileName(), $excludeFileNames)) {
                unlink($entry->getPathname());
            }
        }
        rmdir($dir);
    }

    /**
     * Copy folder recursively - needed for create
     *
     * @param $target
     * @param $destination
     */
    public function copyFolder($target, $destination)
    {
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($target),
            \RecursiveIteratorIterator::SELF_FIRST
        );

        foreach($iterator as $entry) {
            if (substr($entry, -1) == '.') {
                continue;
            }
            if (substr($entry, -2) == '..') {
                continue;
            }

            if ($entry->isDir()) {
                $newDir = $destination . '/' . str_replace($target, "", $entry);

                if (!is_dir($newDir)) {
                    mkdir($newDir, 0755, true);
                }
            } else {
                $newFile = $destination . '/' . str_replace($target, "", (string)$entry);
                if (file_exists((string)$entry)) {
                    copy((string)$entry, (string)$newFile);
                }

            }
        }
    }
}

