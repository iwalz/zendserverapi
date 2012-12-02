<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link 		http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright 	Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license 	http://framework.zend.com/license/new-bsd New BSD License
 * @package 	Zend_Service
 */

namespace ZendService\ZendServerAPI;

/**
 * <b>Configuration Management Methods</b>
 *
 * The following is a list of the available methods used to manage your
 * Zend Server or Zend Server ClusterManager configuration:
 *
 * <ul>
 * <li>The configurationExport Method</li>
 * <li>The configurationImport Method</li>
 * </ul>
 *
 * @license	    http://framework.zend.com/license/new-bsd New BSD License
 * @link		http://github.com/zendframework/zf2 for the canonical source repository
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @category	Zend
 * @package	    Zend_Service
 * @subpackage	ZendServerAPI
 */
class Configuration extends BaseAPI
{
    /**
     * The config file to import
     * @var string
     */
    protected $importFile = null;
    /**
     * Directory where to save exported configs
     * @var string
     */
    protected $exportDirectory = null;

    /**
     * <b>The configurationExport Method</b>
     *
     * <pre>Export the current server/cluster configuration into a file.</pre>
     *
     * @param  string       $exportDirectory <p>Directory where to save the exported configs</p>
     * @param  string       $fileName        <p>Filename to export config to</p>
     * @return \SplFileInfo
     */
    public function configurationExport($exportDirectory = null, $fileName = null)
    {
        if($exportDirectory !== null)
            $this->exportDirectory = $exportDirectory;
        else
            $this->exportDirectory = getcwd();

        $this->request->setAction($this->apiFactory->factory('configurationExport', $this->exportDirectory, $fileName));

        return $this->request->send();
    }

    /**
     * <b>The configurationImport Method</b>
     *
     * <pre>Import a saved configuration snapshot into the server.</pre>
     *
     * @param  string                                           $importFile <p>File to import</p>
     * @return \ZendService\ZendServerAPI\DataTypes\ServersList
     */
    public function configurationImport($importFile = null)
    {
        if($importFile !== null)
            $this->importFile = $importFile;

        $this->request->setAction($this->apiFactory->factory('configurationImport', $this->importFile));

        return $this->request->send();
    }

    /**
     * Get the config file to import
     *
     * @return string
     */
    public function getImportFile()
    {
        return $this->importFile;
    }

    /**
     * Set the import config file
     *
     * @param  string $importFile <p>Full path to file</p>
     * @return void
     */
    public function setImportFile($importFile)
    {
        $this->importFile = $importFile;
    }

    /**
     * Get the directory for saving the configs
     *
     * @return string
     */
    public function getExportDirectory()
    {
        return $this->exportDirectory;
    }

    /**
     * Directory for exported config files
     *
     * @param  string $exportDirectory <p>Set the directory, where to export the config files to</p>
     * @return void
     */
    public function setExportDirectory($exportDirectory)
    {
        $this->exportDirectory = $exportDirectory;
    }
}
