<?php
namespace ZendServerAPI;

class Monitor extends BaseAPI
{
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
     * @param  string                                                       $filterId  The predefined filter's id
     * @param  Integer|null                                                 $limit     The number of rows to retrieve
     * @param  Integer|null                                                 $offset    A paging offset to begin the issues list from
     * @param  string|null                                                  $order     Column identifier for sorting the result set
     * @param  string|null                                                  $direction Sorting direction: Ascending or Descending
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
     * @param  string                                                       $issueId  The issue ID
     * @return \ZendServerAPI\DataTypes\Issue
     */
    public function monitorGetIssueDetails($issueId)
    {
        $this->request->setAction($this->apiFactory->factory('monitorGetIssuesDetails', $issueId));
    
        return $this->request->send();
    }
}
