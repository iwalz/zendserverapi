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
 * <b>The clusterDisableServer Method</b>
 *
 * <pre>This method disables a cluster member. This process may be
 * asynchronous if Session Clustering is used. If this is the case,
 * the initial operation returns an HTTP 202 response. As long as the server is not
 * fully disabled, further calls to this method are idempotent. On a
 * Zend Server Cluster Manager with no valid license, this operation fails.</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class ClusterDisableServer extends Method
{
    /**
     * Parameter for ClusterDisableServer method
     * @var int
     */
    private $serverId = null;

    /**
     * Set arguments for ClusterDisableServer
     *
     * @param int $serverId Id of the server to disable
     */
    public function setArgs($serverId)
    {
        $this->serverId = $serverId;
        
        $this->configure();
    }

    /**
     * Configures all needed information for the method implementation
     *
     * @return void
     */
    public function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/clusterDisableServer');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\ServerInfo());
    }

    /**
     * Content for POST request
     * @return string
     */
    public function getContent()
    {
        return ("serverId=".$this->serverId);
    }
}
