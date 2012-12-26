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
 * <b>The clusterReconfigureServer Method</b>
 *
 * <pre>Re-configure a cluster member to match the cluster's profile.
 * This operation will fail on a Zend Server Cluster Manager with
 * no valid license.</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class ClusterReconfigureServer extends Method
{
    /**
     * ServerId for reconfiguration
     * @var int
     */
    private $server = null;
    /**
     * Restart server after action
     * @var
     */
    private $doRestart = null;

    /**
     * Set arguments for ClusterReconfigureServer
     *
     * @param int $server ServerId to reconfigure
     * @param boolean restart server after action
     */
    public function setArgs($server, $doRestart = false)
    {
        $this->server = $server;
        $this->doRestart = $doRestart;

        $this->configure();

        return $this;
    }

    /**
     * Content for POST request
     *
     * @return string
     */
    public function getContent()
    {
        return ("serverId=".$this->server."&doRestart=".($this->doRestart === true ? 'TRUE' : 'FALSE'));
    }

    /**
     * Configures all needed information for the method implementation
     *
     * @return void
     */
    public function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/clusterReconfigureServer');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\ServerInfo());
    }

}
