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
 * <b>The clusterEnableServer Method</b>
 *
 * <pre>This method is used to re-enable a cluster member.
 * This process may be asynchronous if Session Clustering is used.
 * If this is the case, the initial operation will return an HTTP 202 response.
 * This action is idempotent, and running it on an enabled server will result
 * in a 200 OK response with no consequences.
 * On a Zend Server Cluster Manager with no valid license this operation fails.</pre>
 *
 * @license	http://framework.zend.com/license/new-bsd New BSD License
 * @link		http://github.com/zendframework/zf2 for the canonical source repository
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @category	Zend
 * @package	Zend_Service
 * @subpackage	ZendServerAPI
 */
class ClusterEnableServer extends Method
{
    /**
     * Id of server to enable
     * @var int
     */
    private $serverId = null;

    /**
     * Constructor of ClusterEnableServer method
     *
     * @param int $serverId
     */
    public function __construct($serverId)
    {
        $this->serverId = $serverId;
        parent::__construct();
    }

    /**
     * Configures all needed information for the method implementation
     *
     * @return void
     */
    public function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/clusterEnableServer');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\ServerInfo());
    }

    /**
     * Content for POST request
     *
     * @return string
     */
    public function getContent()
    {
        return ("serverId=".$this->serverId);
    }
}
