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
 * <b>The monitorChangeIssueStatus Method</b>
 *
 * <pre>Modify an Issue's status code based on an Issue's Id and a status code.</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class MonitorChangeIssueStatus extends Method
{
    /**
     * Issue ID
     * @var int
     */
    protected $issueId = null;
    /**
     * The new status to set: Open | Closed | Ignored
     * @var string
     */
    protected $newStatus = null;

    /**
     * Set arguments for MonitorChangeIssueStatus
     *
     * @param int    $issueId   IssueId to change
     * @param string $newStatus The new status to set
     */
    public function setArgs($issueId, $newStatus)
    {
        $this->issueId = $issueId;
        $this->newStatus = $newStatus;

        $this->configure();

        return $this;
    }

    /**
     * Returns the content type
     *
     * @return string
     */
    public function getContentType()
    {
        return "application/x-www-form-urlencoded";
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
     * Configures all needed information for the method implementation
     *
     * @return void
     */
    public function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/Api/monitorChangeIssueStatus');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\Issue());
    }

    /**
     * Content for POST request
     *
     * @return string
     */
    public function getContent()
    {
        return ("issueId=".$this->issueId
               ."&newStatus=".$this->newStatus);
    }
}
