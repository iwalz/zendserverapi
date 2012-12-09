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
 * <b>Codetracing Methods</b>
 *
 * The following is a list of methods available for the Codetracing feature:
 *
 * <ul>
 * <li>codetracingDisable</li>
 * <li>codetracingEnable</li>
 * <li>codetracingIsEnabled</li>
 * <li>codetracingCreate</li>
 * <li>codetracingDelete</li>
 * <li>codetracingList</li>
 * <li>codetracingDownloadTraceFile</li>
 * </ul>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class Codetracing extends BaseAPI
{
    /**
     * The directory where to store the codetrace files
     * @var string
     */
    protected $exportDirectory = null;

    /**
     * <b>The codetracingEnable Method</b>
     *
     * <pre>Enable code-tracing component and two directives necessary
     * for creating tracing dumps
     *
     * This method will force the Zend Server to enable the
     * developerMode. This mode causes the Zend Server to create a
     * dump on every request. <b>Do not use it in production!</b></pre>
     *
     * @param  boolean                                                $restartNow <p>Restart after method call</p>
     * @return \ZendService\ZendServerAPI\DataTypes\CodeTracingStatus
     */
    public function codetracingEnable($restartNow = true)
    {
        $this->sm->get('request')->setAction($this->sm->get('codetracingEnable')->setArgs($restartNow));
        
        return $this->sm->get('request')->send();
    }

    /**
     * <b>The codetracingDisable Method</b>
     *
     * <pre>Disable the code-tracing directive two directives necessary
     * for creating tracing dumps, this action does not disable the code-tracing component.
     *
     * This method will force the Zend Server to disable the
     * developerMode. This mode causes the Zend Server to create a
     * dump on every request. <b>Do not use it in production!</b></pre>
     *
     * @param  boolean                                                $restartNow <p>Restart after method call</p>
     * @return \ZendService\ZendServerAPI\DataTypes\CodeTracingStatus
     */
    public function codetracingDisable($restartNow = true)
    {
        $this->sm->get('request')->setAction($this->sm->get('codetracingDisable')->setArgs($restartNow));
        
        return $this->sm->get('request')->send();
    }

    /**
     * <b>The codetracingIsEnabled Method</b>
     *
     * <pre>Check if the directives zend_codetracing.always_dump and
     * zend_codetracing.trace_enabled are set, and if the code-tracing
     * component is active.
     *
     * This method returns true if developerMode is enabled.
     * The developerMode will cause the Zend Server to create a trace
     * on every request. Do not use it in production</pre>
     *
     * @return \ZendService\ZendServerAPI\DataTypes\CodeTracingStatus
     */
    public function codetracingIsEnabled()
    {
        $this->sm->get('request')->setAction($this->sm->get('codetracingIsEnabled')->setArgs());
        
        return $this->sm->get('request')->send();
    }

    /**
     * <b>The codetracingCreate Method</b>
     *
     * <pre>Create a new code-tracing entry.
     *
     * This method will generate a codetrace of the given URL.
     * The URL needs to be a fully encoded and has to start with
     * the protocoll.</pre>
     *
     * @param  string                                           $url <p>the url to trace</p>
     * @return \ZendService\ZendServerAPI\DataTypes\CodeTracing
     */
    public function codetracingCreate($url)
    {
        $this->sm->get('request')->setAction($this->sm->get('codetracingCreate')->setArgs($url));
        
        return $this->sm->get('request')->send();
    }

    /**
     * <b>The codetracingDelete Method</b>
     *
     * <pre>Delete a code-tracing file entry.</pre>
     *
     * @param  integer                                          $id <p>Trace file ID</p>
     * @return \ZendService\ZendServerAPI\DataTypes\CodeTracing
     */
    public function codetracingDelete($id)
    {
        $this->sm->get('request')->setAction($this->sm->get('codetracingDelete')->setArgs($id));
        
        return $this->sm->get('request')->send();
    }

    /**
     * <b>The codetracingList Method</b>
     *
     * <pre>Retrieve a list of code-tracing files available for download using codetracingDownloadTraceFile.</pre>
     *
     * @param  array                                            $applicationIds <p>List of application IDs</p>
     * @param  int                                              $limit          <p>Row limit to retrieve</p>
     * @param  int                                              $offset         <p>Page offset to be displayed</p>
     * @param  string                                           $orderBy        <p>Column to sort the result by (Id,Date,Url,CreatedBy,FileSize)</p>
     * @param  string                                           $direction      <p>Direction to sort, default to Desc</p>
     * @return \ZendService\ZendServerAPI\DataTypes\CodeTracing
     */
    public function codetracingList($applicationIds = array(), $limit = null, $offset = null, $orderBy = null, $direction = null)
    {
        $this->sm->get('request')->setAction($this->sm->get('codetracingList')->setArgs($applicationIds, $limit, $offset, $orderBy, $direction));
        
        return $this->sm->get('request')->send();
    }

    /**
     * <b>The codetracingDownloadTraceFile Method</b>
     *
     * <pre>Download the amf file specified by the codetracing identifier.</pre>
     *
     * @param  string                                           $traceFile       <p>Trace file identifier</p>
     * @param  string                                           $fileName        <p>Filename to save tracefile to</p>
     * @param  string                                           $exportDirectory <p>Directory to export files to</p>
     * @return \ZendService\ZendServerAPI\DataTypes\CodeTracing
     */
    public function codetracingDownloadTraceFile($traceFile, $fileName = null, $exportDirectory = null)
    {
        if($exportDirectory !== null)
            $this->exportDirectory = $exportDirectory;
        else
            $this->exportDirectory = getcwd();

        $this->sm->get('request')->setAction($this->sm->get('codetracingDownloadTraceFile')->setArgs($traceFile, $fileName, $this->exportDirectory));
        
        return $this->sm->get('request')->send();
    }
}
