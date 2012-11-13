<?php
/**
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * <http://www.rubber-duckling.net>
 */

namespace ZendServerAPI;

class Monitor extends BaseAPI
{
    protected $exportDirectory = null;

    /**
     * The monitorGetRequestSummary Method
     *
     * Retrieve information about a particular request's events and code tracing.
     * The requestUid identifier is provided in a cookie that is set in the response
     * to the particular request.
     * This API action is designed to be used with the new Zend Studio browser toolbar.
     *
     * @param  string       $requestUid Request identifier, obtained from response cookie
     * @return \SplFileInfo
     */
    public function monitorGetRequestSummary($requestUid)
    {
        $this->request->setAction($this->apiFactory->factory('monitorGetRequestSummary', $requestUid));

        return $this->request->send();
    }

    /**
     * Method MonitorGetIssuesListByPredefinedFilter
     *
     * Retrieve a list of monitor issues according to a preset filter identifier.
     * The filter identifier is shared with the UI's predefined filters.
     * This WebAPI method may also accept ordering details and paging limits.
     * The response is a list of issue elements with their general details and event-groups identifiers.
     *
     * @param  string                             $filterId  The predefined filter's id
     * @param  Integer|null                       $limit     The number of rows to retrieve
     * @param  Integer|null                       $offset    A paging offset to begin the issues list from
     * @param  string|null                        $order     Column identifier for sorting the result set
     * @param  string|null                        $direction Sorting direction: Ascending or Descending
     * @return \ZendServerAPI\DataTypes\IssueList
     */
    public function monitorGetIssuesListByPredefinedFilter($filterId, $limit = null, $offset = null, $order = null, $direction = null)
    {
        $this->request->setAction($this->apiFactory->factory('monitorGetIssuesListByPredefinedFilter', $filterId, $limit, $offset, $order, $direction));

        return $this->request->send();
    }

    /**
     * Method MonitorGetIssuesDetails
     *
     * Retrieves the details for the given issue ID.
     * The issue ID can be found dynamically with monitorGetIssuesListByPredefinedFilter and
     * one of the standard filters.
     *
     * @param  string                                $issueId The issue ID
     * @return \ZendServerAPI\DataTypes\IssueDetails
     */
    public function monitorGetIssueDetails($issueId)
    {
        $this->request->setAction($this->apiFactory->factory('monitorGetIssuesDetails', $issueId));

        return $this->request->send();
    }

    /**
     * Method MonitorGetEventGroupDetails
     *
     * Retrieves the details for the given issue ID.
     * The issue ID can be found dynamically with monitorGetIssuesListByPredefinedFilter and
     * one of the standard filters. If you run that action without the eventsGroupId parameter
     * it will perform a monitorGetIssueDetails call before and pick the first id
     *
     * @param  string                                      $issueId       The issue ID
     * @param  Integer                                     $eventsGroupId The events group id
     * @return \ZendServerAPI\DataTypes\EventsGroupDetails
     */
    public function monitorGetEventGroupDetails($issueId, $eventsGroupId = null)
    {
        if ($eventsGroupId === null) {
            $this->request->setAction($this->apiFactory->factory('monitorGetIssuesDetails', $issueId));
            $event = $this->request->send();
            $eventsGroups = $event->getEventsGroups();
            $eventsGroupId = $eventsGroups[0]->getEventsGroupId();

            // Reset request
            $this->request = Startup::getRequest($this->name);
        }
        $this->request->setAction($this->apiFactory->factory('monitorGetEventGroupDetails', $issueId, $eventsGroupId));

        return $this->request->send();
    }

    /**
     * Method MonitorChangeIssueStatus
     *
     * Retrieves the details for the given issue ID.
     * The issue ID can be found dynamically with monitorGetIssuesListByPredefinedFilter and
     * one of the standard filters.
     *
     * @param  string                                $issueId   The issue ID
     * @param  string                                $newStatus The new status, Open | Closed | Ignored
     * @return \ZendServerAPI\DataTypes\IssueDetails
     */
    public function monitorChangeIssueStatus($issueId, $newStatus)
    {
        $this->request->setAction($this->apiFactory->factory('monitorChangeIssueStatus', $issueId, $newStatus));

        return $this->request->send();
    }

    /**
     * Method MonitorExportIssueByEventsGroup
     *
     * Export an issue, identified the given eventsgroup id.
     * Return the SplFileInfo of the downloaded file
     *
     * @param  string       $eventsGroupId The event group ID
     * @return \SplFileInfo
     */

    public function monitorExportIssueByEventsGroup($eventsGroupId, $exportDirectory = null, $fileName = null)
    {
        if($exportDirectory !== null)
            $this->exportDirectory = $exportDirectory;
        else
            $this->exportDirectory = getcwd();

        $this->request->setAction($this->apiFactory->factory('monitorExportIssueByEventsGroup', $eventsGroupId, $this->exportDirectory, $fileName));

        return $this->request->send();
    }

    /**
     * Method monitorDownloadTraceFile
     *
     * Download a trace file. Alias for Codetracing::downloadTraceFile
     *
     * @param  string       $eventsGroupId The event group ID
     * @return \SplFileInfo
     */

    public function monitorDownloadTraceFile($traceFile, $exportDirectory = null, $fileName = null)
    {
        if($exportDirectory !== null)
            $this->exportDirectory = $exportDirectory;
        else
            $this->exportDirectory = getcwd();

        $this->request->setAction($this->apiFactory->factory('codetracingDownloadTraceFile', $traceFile, $fileName, $this->exportDirectory));

        return $this->request->send();
    }

    /**
     * @return the $exportDirectory
     */
    public function getExportDirectory ()
    {
        return $this->exportDirectory;
    }

    /**
     * @param NULL $exportDirectory
     */
    public function setExportDirectory ($exportDirectory)
    {
        $this->exportDirectory = $exportDirectory;
    }

}
