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
 * <b>The clusterRemoveServer Method</b>
 *
 * <pre>This method removes a server from the cluster. The removal
 * process may be asynchronous if Session Clustering is used. If this
 * is the case, the initial operation will return an HTTP 202 response.
 * As long as the server is not fully removed, further calls to remove
 * the same server should be idempotent. On a Zend Server Cluster Manager
 * with no valid license, this operation fails.</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class ClusterRemoveServer extends Method
{
    /**
     * ServerId to remove
     * @var int
     */
    private $server = null;
    /**
     * Force remove
     * @var bool
     */
    private $force = null;

    /**
     * Constructor for ClusterRemoveServer method
     *
     * @param int  $server ServerId to remove
     * @param bool $force  Force remove
     */
    public function __construct($server, $force = false)
    {
        $this->server = $server;
        $this->force = $force;
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
        $this->setFunctionPath('/ZendServerManager/Api/clusterRemoveServer');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\ServerInfo());
    }

    /**
     * Content for POST request
     *
     * @return string
     */
    public function getContent()
    {
        return ("serverId=".$this->server."&force=".($this->force === true ? 'TRUE' : 'FALSE'));
    }
}
