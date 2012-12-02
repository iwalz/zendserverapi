<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link 		http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright 	Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license 	http://framework.zend.com/license/new-bsd New BSD License
 * @package 	Zend_Service
 */

namespace ZendService\ZendServerAPI\Method;

/**
 * <b>The monitorGetIssuesDetails Method</b>
 *
 * <pre>Retrieve an issue's details according to the issueId passed as a
 * parameter. Additional information about event groups is also displayed.</pre>
 *
 * @license	    http://framework.zend.com/license/new-bsd New BSD License
 * @link		http://github.com/zendframework/zf2 for the canonical source repository
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @category	Zend
 * @package	    Zend_Service
 * @subpackage	ZendServerAPI
 */
class MonitorGetIssuesDetails extends Method
{
    /**
     * The issue ID of the issue to get the details for
     * @var string
     */
    protected $issueId = null;

    /**
     * Constructor of method MonitorGetIssuesDetails
     *
     * Retrieves the details of the given issue id.
     *
     * @param  string                                                    $issueId The issue ID
     * @return \ZendService\ZendServerAPI\Method\MonitorGetIssuesDetails
     */
    public function __construct($issueId)
    {
        $this->issueId = $issueId;
        parent::__construct();
    }

    /**
     * Configures all needed information for the method implementation
     *
     * @return void
     */
    public function configure ()
    {
        $this->setMethod('GET');
        $this->setFunctionPath('/ZendServerManager/Api/monitorGetIssueDetails');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\IssueDetails());
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
        $link = $this->getFunctionPath();
        $link .= "?issueId=".$this->issueId;

        return $link;
    }
}
