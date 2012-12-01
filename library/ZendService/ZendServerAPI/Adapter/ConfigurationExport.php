<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link 		http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright 	Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license 	http://framework.zend.com/license/new-bsd New BSD License
 * @package 	Zend_Service
 */

namespace ZendService\ZendServerAPI\Adapter;

/**
 * ConfigurationExport datatype adapter implementation
 *
 * @license	http://framework.zend.com/license/new-bsd New BSD License
 * @link		http://github.com/zendframework/zf2 for the canonical source repository
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @category	Zend
 * @package	Zend_Service
 * @subpackage	ZendServerAPI
 */
class ConfigurationExport extends Adapter
{
    /**
     * Filename to save file locally
     * @var string
     */
    private $fileName = null;
    /**
     * Directory where to export the downloaded files
     * @var string
     */
    private $exportDirectory = null;

    /**
     * Parse the xml response in object mappings
     *
     * @return \SplFileInfo
     */
    public function parse ()
    {
        if ($this->fileName === null) {
            $contentDisposition = $this->getResponse()->getContentDisposition();
            $parts = explode("\"", $contentDisposition);
            $fileName = $this->exportDirectory . DIRECTORY_SEPARATOR . $parts[1];
        } else {
            $fileName = $this->exportDirectory . DIRECTORY_SEPARATOR . $this->fileName;
        }
        file_put_contents( $fileName, $this->getResponse()->getBody());

        return new \SplFileInfo($fileName);
    }

    /**
     * Get the directory, where to save the downloaded files to
     *
     * @return string
     */
    public function getExportDirectory()
    {
        return $this->exportDirectory;
    }

    /**
     * Set the directory, where to save the downloaded files to
     *
     * @param  string $exportDirectory
     * @return void
     */
    public function setExportDirectory($exportDirectory)
    {
        $this->exportDirectory = $this->checkPermission($exportDirectory);
    }

    /**
     * Set the filename where to save the file to (locally)
     *
     * @param  string $fileName
     * @return void
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * Get the filename where to save the file to (locally)
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Check the permissions and returns the realpath for the directory
     *
     * @param  string                    $directory
     * @throws \InvalidArgumentException
     * @return string
     */
    private function checkPermission($directory)
    {
        $directoryRealpath = realpath($directory);
        if(!is_dir($directory))
            throw new \InvalidArgumentException("Directory " . $directory . " does not exist");
        if(!is_writable($directory))
            throw new \InvalidArgumentException("Directory " . $directory . " is not writeable");

        return $directoryRealpath;
    }
}
