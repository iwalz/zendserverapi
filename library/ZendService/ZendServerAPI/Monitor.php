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

/**
 * <b>Monitor Methods</b>
 *
 * The following is a list of methods available for the Monitoring feature:
 *
 * <ul>
 * <li>monitorGetRequestSummary</li>
 * <li>monitorDownloadTraceFile(codetracingDownloadTraceFile)</li>
 * <li>monitorStartDebug(studioStartDebug)</li>
 * <li>monitorGetIssuesListByPredefinedFilter</li>
 * <li>monitorGetIssuesDetails</li>
 * <li>monitorGetEventGroupDetails</li>
 * <li>monitorExportIssueByEventsGroup</li>
 * <li>monitorChangeIssueStatus</li>
 * </ul>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class Monitor extends BaseAPI
{
    /**
     * Directory where to save files to
     * @var string
     */
    protected $exportDirectory = null;

    /**
     * <b>The monitorGetRequestSummary Method</b>
     *
     * <pre><b>This method is not implemented - the functionality was not testable</b>
     *
     * Retrieve information about a particular request's events and code tracing.
     * The requestUid identifier is provided in a cookie that is set in the response
     * to the particular request.
     * This API action is designed to be used with the new Zend Studio browser toolbar.</pre>
     *
     * @param string $requestUid <p>Request identifier, obtained from
     * response cookie</p>
     * @return \SplFileInfo
     */
    public function monitorGetRequestSummary($requestUid)
    {
        throw new \RuntimeException("Method 'monitorGetRequestSummary' is not implemented!");

        //$this->request->setAction($this->apiFactory->factory('monitorGetRequestSummary', $requestUid));
        //return $this->request->send();
    }

    /**
     * <b>The monitorGetIssuesListByPredefinedFilter Method</b>
     *
     * <pre>Retrieve a list of monitor issues according to a preset filter identifier.
     * The filter identifier is shared with the UI's predefined filters.
     * This WebAPI method may also accept ordering details and paging limits.
     * The response is a list of issue elements with their general details and event-groups identifiers.</pre>
     *
     * @param string $filterId
     * <p>The predefined filter's id. Can be the filter's “name” or the
     * actual identifier randomly created by the system.
     * This parameter is case-sensitive</p>
     * @param int|null $limit
     * <p>The number of rows to retrieve. Default lists
     * all events up to an arbitrary limit set by the system</p>
     * @param int|null $offset
     * <p>A paging offset to begin the issues list from. Default is 0</p>
     * @param string|null $order
     * <p>Column identifier for sorting the result set
     * (id, repeats, date, eventType, fullUrl, severity, status).
     * Default is date</p>
     * @param string|null $direction
     * <p>Sorting direction: Ascending or Descending. Default is Descending</p>
     * @param array $filters
     * <p>Add filter parameters in an ad-hoc manner</p>
     * @return \ZendService\ZendServerAPI\DataTypes\IssueList
     */
    public function monitorGetIssuesListByPredefinedFilter($filterId, $limit = null, $offset = null, $order = null, $direction = null, array $filters = array())
    {
        $this->pluginManager->get('request')->setAction($this->pluginManager->get('monitorGetIssuesListByPredefinedFilter')->setArgs($filterId, $limit, $offset, $order, $direction, $filters));

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The monitorGetIssuesDetails Method</b>
     *
     * <pre>Retrieves the details for the given issue ID.
     * The issue ID can be found dynamically with monitorGetIssuesListByPredefinedFilter and
     * one of the standard filters.</pre>
     *
     * @param string $issueId
     * <p>The Issue id.</p>
     * @return \ZendService\ZendServerAPI\DataTypes\IssueDetails
     */
    public function monitorGetIssueDetails($issueId)
    {
        $this->pluginManager->get('request')->setAction($this->pluginManager->get('monitorGetIssuesDetails')->setArgs($issueId));

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The monitorGetEventGroupDetails Method</b>
     *
     * <pre>Retrieves the details for the given issue ID.
     * The issue ID can be found dynamically with monitorGetIssuesListByPredefinedFilter and
     * one of the standard filters. If you run that action without the eventsGroupId parameter
     * it will perform a monitorGetIssueDetails call before and pick the first id</pre>
     *
     * @param string $issueId
     * <p>Issue identifier, provided in the issue element</p>
     * @param int $eventsGroupId
     * <p>Event group identifier, provided in the issue element</p>
     * @return \ZendService\ZendServerAPI\DataTypes\EventsGroupDetails
     */
    public function monitorGetEventGroupDetails($issueId, $eventsGroupId = null)
    {
        if ($eventsGroupId === null) {
            $eventsGroupId = $this->getFirstEventGroupsIdByIssueId($issueId);
        }
        $this->pluginManager->get('request')->setAction($this->pluginManager->get('monitorGetEventGroupDetails')->setArgs($issueId, $eventsGroupId));

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The monitorChangeIssueStatus Method</b>
     *
     * <pre>Modify an Issue's status code based on an Issue's
     * Id and a status code.</pre>
     *
     * @param  string                                            $issueId   <p>The issue ID</p>
     * @param  string                                            $newStatus <p>The new status, Open | Closed | Ignored</p>
     * @return \ZendService\ZendServerAPI\DataTypes\IssueDetails
     */
    public function monitorChangeIssueStatus($issueId, $newStatus)
    {
        $this->pluginManager->get('request')->setAction($this->pluginManager->get('monitorChangeIssueStatus')->setArgs($issueId, $newStatus));

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The monitorExportIssueByEventsGroup Method</b>
     *
     * <pre>Export an archive containing all of the issue's information,
     * event groups and code tracing if available, ready for consumption
     * by Zend Studio. The response is a binary payload.</pre>
     *
     * @param string $issueId       <p>The issue identifier</p>
     * @param string $eventsGroupId <p>The issue event group identifier</p>
     * @param string $fileName
     * <p>The filename where to save the exported issue to.
     * Default is the given name from Zend Server</p>
     * @param string $exportDirectory
     * <p>The directory where to export the issue. Default is getcwd()</p>
     * @return \SplFileInfo
     */
    public function monitorExportIssueByEventsGroup($issueId, $eventsGroupId = null, $fileName = null, $exportDirectory = null)
    {
        if ($eventsGroupId === null) {
            $eventsGroupId = $this->getFirstEventGroupsIdByIssueId($issueId);
        }

        if($exportDirectory !== null)
            $this->exportDirectory = $exportDirectory;
        else
            $this->exportDirectory = getcwd();

        $this->pluginManager->get('request')->setAction($this->pluginManager->get('monitorExportIssueByEventsGroup')->setArgs($eventsGroupId, $this->exportDirectory, $fileName));

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The monitorDownloadTraceFile Method</b>
     *
     * <pre>Download a trace file. Alias for Codetracing::downloadTraceFile</pre>
     *
     * @param string $traceFile
     * <p>Trace file identifier. Note that a codetracing identifier is provided
     * as part of the monitorGetRequestSummary xml response</p>
     * @param string $exportDirectory
     * <p>The directory where to export the tracefile to. Default is getcwd()</p>
     * @param string $fileName
     * <p>The filename where to save the exported issue to.
     * Default is the given name from Zend Server</p>
     * @return \SplFileInfo
     */
    public function monitorDownloadTraceFile($traceFile, $exportDirectory = null, $fileName = null)
    {
        if($exportDirectory !== null)
            $this->exportDirectory = $exportDirectory;
        else
            $this->exportDirectory = getcwd();

        $this->pluginManager->get('request')->setAction($this->pluginManager->get('codetracingDownloadTraceFile')->setArgs($traceFile, $fileName, $this->exportDirectory));

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <pre>Get the global directory setting for all
     * methods that export files in this class</pre>
     *
     * @return string
     */
    public function getExportDirectory ()
    {
        return $this->exportDirectory;
    }

    /**
     * <pre>Set the global setting for the export directory.
     * All files will be saved here unless something else
     * passed to the methods</pre>
     *
     * @param string $exportDirectory <p>The directory where
     * to save the files to.Can be set globally here</p>
     * @return void
     */
    public function setExportDirectory ($exportDirectory)
    {
        $this->exportDirectory = $exportDirectory;
    }

}
