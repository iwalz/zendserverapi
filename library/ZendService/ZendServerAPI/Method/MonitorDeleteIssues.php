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
 * <b>The monitorDeleteIssues Method</b>
 *
 * <pre>Delete monitor issues based on issueIds passed. Response returns the amount of issues that were deleted.
 * Note though, that as this method only marks the issues for deletion, subsequent calls with the same parameters
 * will return the same size of issues deleted rather than expected 0.</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Kevin Papst <kpapst@gmx.net>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class MonitorDeleteIssues extends Method
{
    /**
     * The issue IDs to be deleted
     * @var string
     */
    protected $issueIds = array();

    /**
     * Set arguments for MonitorDeleteIssues
     *
     * Deletes all issues with the given IDs.
     *
     * @param array $issueIds
     * @return \ZendService\ZendServerAPI\Method\MonitorDeleteIssues
     */
    public function setArgs(array $issueIds)
    {
        $this->issueIds = $issueIds;

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
        $this->setFunctionPath('/Api/monitorDeleteIssues');
        $this->setParser(new \ZendService\ZendServerAPI\Adapter\MonitorDeleteIssues());
    }

    /**
     * Returns the accept header
     *
     * @return string
     */
    public function getAcceptHeader()
    {
        return "application/vnd.zend.serverapi+xml;version=1.3";
    }

    /**
     * Get link for the method
     *
     * @return string
     */
    public function getContent()
    {
        $link = "";
        //$link = "?";
        //$link .= $this->getFunctionPath();
        $link .= $this->buildParameterArray('issuesIds', $this->issueIds);

        return $link;
    }
}
