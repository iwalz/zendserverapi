<?php
namespace ZendServerAPI;

class Codetracing extends BaseAPI
{
    /**
     * Implementation of codetracingEnable method
     * 
     * This method will cause the Zend Server to enable the
     * developerMode. This mode causes the Zend Server to create a
     * dump on every request. Do not use it in production
     *
     * @param  boolean                                    $restartNow Restart after method call
     * @return \ZendServerAPI\DataTypes\CodeTracingStatus
     */
    public function codetracingEnable($restartNow = true)
    {
        $this->request->setAction($this->apiFactory->factory('codetracingEnable', $restartNow));

        return $this->request->send();
    }

    /**
     * Implementation of codetracingDisable method
     * 
     * This method will cause the Zend Server to disable the
     * developerMode. This mode causes the Zend Server to create a 
     * dump on every request. Do not use it in production
     *
     * @param  boolean                                    $restartNow Restart after method call
     * @return \ZendServerAPI\DataTypes\CodeTracingStatus
     */
    public function codetracingDisable($restartNow = true)
    {
        $this->request->setAction($this->apiFactory->factory('codetracingDisable', $restartNow));

        return $this->request->send();
    }

    /**
     * Implementation of codetracingIsEnabled method
     * 
     * This method returns true if developerMode is enabled.
     * The developerMode will cause the Zend Server to create a trace 
     * on every request. Do not use it in production
     *
     * @access public
     * @return \ZendServerAPI\DataTypes\CodeTracingStatus
     */
    public function codetracingIsEnabled()
    {
        $this->request->setAction($this->apiFactory->factory('codetracingIsEnabled'));

        return $this->request->send();
    }

    /**
     * Implementation of codetracingCreate method
     * 
     * This method will generate a codetrace of the given URL.
     * The URL needs to be a fully encoded and has to start with 
     * the protocoll.
     *
     * @param  string                               $url the url to trace
     * @return \ZendServerAPI\DataTypes\CodeTracing
     */
    public function codetracingCreate($url)
    {
        $this->request->setAction($this->apiFactory->factory('codetracingCreate', $url));

        return $this->request->send();
    }

    /**
     * Implementation of codetracingDelete method
     * 
     * This method will delete the codetrace file from the zend server.
     *
     * @param  integer                              $id Trace file ID
     * @return \ZendServerAPI\DataTypes\CodeTracing
     */
    public function codetracingDelete($id)
    {
        $this->request->setAction($this->apiFactory->factory('codetracingDelete', $id));

        return $this->request->send();
    }

    /**
     * Implementation of codetracingList method
     * 
     * This method will give you a list of all codetraces from the zend server.
     *
     * @param  array                                $applicationIds List of application IDs
     * @param  integer                              $limit          Row limit to retrieve
     * @param  integer                              $offset         Page offset to be displayed
     * @param  string                               $orderBy        Column to sort the result by (Id,Date,Url,CreatedBy,FileSize)
     * @param  string                               $direction      Direction to sort, default to Desc
     * @return \ZendServerAPI\DataTypes\CodeTracing
     */
    public function codetracingList($applicationIds = array(), $limit = null, $offset = null, $orderBy = null, $direction = null)
    {
        $this->request->setAction($this->apiFactory->factory('codetracingList', $applicationIds, $limit, $offset, $orderBy, $direction));

        return $this->request->send();
    }

    /**
     * Implementation of codetracingDownloadTraceFile method
     * 
     * This method will download the expected tracefile (if existing) 
     * and store it locally.
     *
     * @param  string                               $traceFile Trace file identifier
     * @param  string                               $fileName  Filename to save tracefile to
     * @return \ZendServerAPI\DataTypes\CodeTracing
     */
    public function codetracingDownloadTraceFile($traceFile, $fileName = null, $exportDirectory = null)
    {
        $this->request->setAction($this->apiFactory->factory('codetracingDownloadTraceFile', $traceFile, $fileName, $exportDirectory));

        return $this->request->send();
    }
}
