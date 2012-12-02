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
 * <b>The monitorGetRequestSummary Method</b>
 *
 * <pre>Retrieve information about a particular request's events and code tracing.
 * The requestUid identifier is provided in a cookie that is set in the response
 * to the particular request. This API action is designed to be used with the
 * new Zend Studio browser toolbar.</pre>
 *
 * @license	    http://framework.zend.com/license/new-bsd New BSD License
 * @link		http://github.com/zendframework/zf2 for the canonical source repository
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @category	Zend
 * @package	    Zend_Service
 * @subpackage	ZendServerAPI
 */
class MonitorGetRequestSummary extends Method
{
    /**
     * Request identifier
     * @var string
     */
    private $requestUid = null;

    /**
     * Constructor of method ApplicationGetStatus
     *
     * @param array Applications to get status for
     */
    public function __construct($requestUid)
    {
        $this->requestUid = $requestUid;
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
        $this->setFunctionPath('/ZendServerManager/Api/monitorGetRequestSummary');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\RequestSummary());
    }

    /**
     * Get link for the method
     *
     * @return string
     */
    public function getLink()
    {
        $link = $this->getFunctionPath();
        $link .= "?requestUid=".$this->requestUid;

        return $link;
    }
}
