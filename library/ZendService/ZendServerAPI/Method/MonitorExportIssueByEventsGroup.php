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

/**
 * <b>The monitorExportIssueByEventsGroup Method</b>
 *
 * <pre>Export an archive containing all of the issue's information,
 * event groups and code tracing if available, ready for consumption by Zend Studio.
 * The response is a binary payload.</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class MonitorExportIssueByEventsGroup extends Method
{
    /**
     * The events group identifier
     * @var int
     */
    protected $eventsGroupId = null;

    /**
     * Set arguments for MonitorExportIssueByEventsGroup
     *
     * @param int    $eventsGroupId   the events group identifier
     * @param string $exportDirectory the directory where to export files to
     * @param string $fileName        the file where to export the data to
     */
    public function setArgs($eventsGroupId, $exportDirectory = null, $fileName = null)
    {
        $this->configure();

        if($exportDirectory !== null)
            $this->setExportDirectory($exportDirectory);

        if($fileName !== null)
            $this->setFileName($fileName);

        $this->eventsGroupId = $eventsGroupId;
    }

    /**
     * Configures all needed information for the method implementation
     *
     * @return void
     */
    public function configure()
    {
        $this->setFunctionPath('/ZendServerManager/Api/monitorExportIssueByEventsGroup');
        $this->setMethod('GET');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\MonitorExportIssueByEventsGroup());
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
     * Get link for the method
     *
     * @return string
     */
    public function getLink()
    {
        $link = parent::getLink();
        $link .= '?eventGroupId='.$this->eventsGroupId;

        return $link;
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
