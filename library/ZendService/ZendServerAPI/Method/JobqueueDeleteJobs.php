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
 * <b>The jobqueueJobsList Method</b>
 *
 * <pre>Retrieve and display a list of jobs</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class JobqueueJobsList extends Method
{
    protected $jobs = array();

    /**
     * set arguments for JobqueueJobsList
     *
     * @param
     */
    public function setArgs($jobs)
    {
        $this->jobs = $jobs;
        $this->configure();

        return $this;
    }

    /**
     * Configures all needed information for the method implementation
     *
     * @return void
     */
    public function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/jobqueueDeleteJobs');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\DumpParser());
    }

    /**
     * Returns the correct accept header for a specific version
     *
     * @see \ZendService\ZendServerAPI\Method\Method::getAcceptHeader()
     * @return string
     */
    public function getAcceptHeader()
    {
        return "application/vnd.zend.serverapi+xml;version=1.3";
    }

    /**
     * Get post body content
     *
     * @return string
     */
    public function getContent()
    {
        $content = $this->buildParameterArray('jobs', $this->jobs);

        return $content;
    }
}
