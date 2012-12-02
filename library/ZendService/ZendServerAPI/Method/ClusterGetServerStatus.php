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
use ZendService\ZendServerAPI\DataTypes\ServersList,
    ZendService\ZendServerAPI\DataTypes\ServerInfo,
    ZendService\ZendServerAPI\DataTypes\MessageList;

/**
 * <b>The clusterGetServerStatus Method</b>
 *
 * <pre>Use this method to get the list of servers in the cluster and
 * the status of each one. On a Zend Server Cluster Manager with no valid license,
 * this operation fails. This operation causes Zend Server Cluster Manager to
 * check the status of servers and return fresh, non-cached information.
 * This is different from the Servers List tab in the GUI, which may present
 * cached information. Users interested in reducing load by caching this
 * information should do it in their own code.</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class ClusterGetServerStatus  extends Method
{
    /**
     * Servers to get the status for
     * @var array
     */
    private $servers = null;

    /**
     * Constructor for ClusterGetServerStatus
     *
     * @param array $servers Default returns all servers of the cluster
     */
    public function __construct(array $servers = array())
    {
        $this->servers = $servers;
        parent::__construct();
    }

    /**
     * Configures all needed information for the method implementation
     *
     * @return void
     */
    public function configure()
    {
        $this->setMethod('GET');
        $this->setFunctionPath('/ZendServerManager/Api/clusterGetServerStatus');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\ServersList());
    }

    /**
     * Set the list of server ids
     *
     * @param array $servers
     */
    public function setParameters(array $servers)
    {
        $this->servers = $servers;
    }

    /**
     * Get link for the method
     *
     * @return string
     */
    public function getLink()
    {
        $link = $this->getFunctionPath();
        $parameterCount = count($this->servers);

        if($parameterCount > 0)
            $link .= "?";

        $link .= $this->buildParameterArray('servers', $this->servers);

        return $link;
    }

}
