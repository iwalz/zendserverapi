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
 * <b>The monitorGetEventGroupDetails Method</b>
 *
 * <pre>Retrieve an events list object identified by an events-group identifier.
 * The events-group identifier is retrieved from an Issue element's data.</pre>
 *
 * @license	http://framework.zend.com/license/new-bsd New BSD License
 * @link		http://github.com/zendframework/zf2 for the canonical source repository
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @category	Zend
 * @package	Zend_Service
 * @subpackage	ZendServerAPI
 */
class MonitorGetEventGroupDetails extends Method
{
    /**
     * The issue ID of the issue to get the details for
     * @var string
     */
    protected $issueId = null;
    /**
     * Event group identifier, provided in the issue element
     * @var int
     */
    protected $eventsGroupId = null;

    /**
     * Constructor of method MonitorGetEventGroupDetails
     *
     * Retrieves the details of the given issue id.
     *
     * @param  string                                                        $issueId       The issue ID
     * @param  int                                                           $eventsGroupId The event group identifier
     * @return \ZendService\ZendServerAPI\Method\MonitorGetEventGroupDetails
     */
    public function __construct($issueId, $eventsGroupId)
    {
        $this->issueId = $issueId;

        $this->eventsGroupId = $eventsGroupId;
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
        $this->setFunctionPath('/ZendServerManager/Api/monitorGetEventGroupDetails');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\EventsGroupDetails());
    }

    /**
     * Returns the default accept header
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
        $link .= "&eventGroupId=".$this->eventsGroupId;

        return $link;
    }
}
