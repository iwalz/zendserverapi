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

use ZendService\ZendServerAPI\Adapter\CodetracingDownloadTraceFile as CodetracingDownloadTraceFileAdapter;

/**
 * <b>The codetracingDownloadTraceFile Method</b>
 *
 * <pre>Download the amf file specified by the codetracing identifier.</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class CodetracingDownloadTraceFile extends Method
{
    /**
     * Trace file identifier
     * @var string
     */
    protected $traceFile = null;
    /**
     * Filename where to export data to
     * @var string
     */
    protected $fileName = null;
    /**
     * Directory where to export files to
     * @var string
     */
    protected $exportDirectory = null;

    /**
     * Constructor for CodetracingDownloadTraceFile
     *
     * @param string $traceFile       Trace file identifier
     * @param string $fileName        Filename where to export data to
     * @param string $exportDirectory Directory where to export file to
     */
    public function __construct($traceFile, $fileName = null, $exportDirectory = null)
    {
        parent::__construct();

        $this->traceFile = $traceFile;
        $this->setExportDirectory($exportDirectory);
        $this->setFileName($fileName);
    }

    /**
     * Configures all needed information for the method implementation
     *
     * @return void
     */
    public function configure()
    {
        $this->setFunctionPath('/ZendServerManager/Api/codetracingDownloadTraceFile');
        $this->setMethod('GET');
        $this->setParser(new CodetracingDownloadTraceFileAdapter());
    }

    /**
     * Get link for the method
     *
     * @return string
     */
    public function getLink()
    {
        $link = parent::getLink();
        $link .= '?traceFile='.$this->traceFile;

        return $link;
    }

    /**
     * Returns the accept header
     *
     * @return string
     */
    public function getAcceptHeader()
    {
        return "application/vnd.zend.serverapi+xml;version=1.2";
    }

    /**
     * Get the directory where to export the files to
     * Proxy for the export directory in the adapter
     *
     * @return string
     */
    public function getExportDirectory()
    {
        return $this->getParser()->getExportDirectory();
    }

    /**
     * Set the directory where to export the files to.
     * Proxy for the adapter
     *
     * @param  string $exportDirectory
     * @return void
     */
    public function setExportDirectory($exportDirectory)
    {
        $this->getParser()->setExportDirectory($exportDirectory);
    }

    /**
     * Set the fileName where to export the file to
     * Proxy to the adapter
     *
     * @param  string $fileName
     * @return void
     */
    public function setFileName($fileName)
    {
        $this->getParser()->setFileName($fileName);
    }

    /**
     * Get the filename where to export the file to
     * Proxy to the adapter
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->getParser()->getFileName();
    }
}
