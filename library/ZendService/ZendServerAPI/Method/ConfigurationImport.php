<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright      Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @package        Zend_Service
 */

namespace ZendService\ZendServerAPI\Method;

use ZendService\ZendServerAPI\Adapter\ServersList;

/**
 * <b>The configurationImport Method</b>
 *
 * <pre>Import a saved configuration snapshot into the server.</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class ConfigurationImport extends Method
{
    /**
     * File to import
     * @var string
     */
    private $file = null;

    /**
     * Set arguments for ConfigurationImport
     *
     * @param string $file The file to import
     */
    public function setArgs($file = null)
    {
        $this->configure();

        if($file !== null)
            $this->file = $file;

        return $this;
    }

    /**
     * Configures all needed information for the method implementation
     *
     * @return void
     */
    public function configure()
    {
        $this->setFunctionPath('/ZendServerManager/Api/configurationImport');
        $this->setMethod('POST');
        $this->setParser(new ServersList());
    }

    /**
     * Returns the content type
     *
     * @return string
     */
    public function getContentType()
    {
        return 'application/x-www-form-urlencoded';
    }

    /**
     * Get the files to post
     *
     * @return array
     */
    public function getPostFiles()
    {
        return array('configFile' => array('fileName' => $this->file, 'contentType' => 'application/vnd.zend.serverconfig'));
    }

    /**
     * Returns the content
     *
     * @return string
     */
    public function getContent()
    {
        return null;
    }

    /**
     * Get the fileName which file needs to be imported
     *
     * @return string
     */
    public function getImportFile()
    {
        return $this->file;
    }

    /**
     * Set the fileName which file needs to be imported
     *
     * @param  string $importFile
     * @return void
     */
    public function setImportFile($importFile)
    {
        $this->file = $importFile;
    }
}
