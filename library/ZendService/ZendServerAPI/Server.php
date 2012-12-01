<?php
/**
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * <http://www.rubber-duckling.net>
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendService\ZendServerAPI
 */

namespace ZendService\ZendServerAPI;

/**
 * <b>Server and Cluster Management Methods</b>
 *
 * The following is a list of the available methods used to manage your server and/or cluster:
 *
 * <ul>
 * <li>getSystemInfo</li>
 * <li>clusterGetServerStatus</li>
 * <li>clusterAddServer</li>
 * <li>clusterRemoveServer</li>
 * <li>clusterDisableServer</li>
 * <li>clusterEnableServer</li>
 * <li>clusterReconfigureServer</li>
 * <li>restartPHP</li>
 * </ul>
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendService\ZendServerAPI
 */
class Server extends BaseAPI
{
    /**
     * Break loops for wait methods after this number of tries
     * @var int
     */
    const DEFAULT_WAITINTERVAL = 5;
    /**
     * <b>The getSystemInfo Method</b>
     *
     * <pre>Use this method to get information about the system, including the Zend Server edition and version, PHP
     * version, licensing information, etc. This method produces similar output on all Zend Server systems,
     * and is future compatible.</pre>
     *
     * @return \ZendService\ZendServerAPI\DataTypes\SystemInfo
     */
    public function getSystemInfo()
    {
        $this->request->setAction($this->apiFactory->factory('getSystemInfo'));

        return $this->request->send();
    }

    /**
     * <b>The clusterGetServerStatus Method</b>
     *
     * <pre>Use this method to get the list of servers in the cluster and the status of each one.
     * On a Zend Server Cluster Manager with no valid license, this operation fails.
     * This operation causes Zend Server Cluster Manager to check the status of servers and return fresh,
     * non-cached information. This is different from the Servers List tab in the GUI,
     * which may present cached information. Users interested in reducing load by caching this
     * information should do it in their own code.</pre>
     *
     * @param array $parameters <p>A list of server IDs. If specified,
     * the status is returned for these servers only. If not specified,
     * the status of all the servers is returned.</p>
     * @return \ZendService\ZendServerAPI\DataTypes\ServersList
     */
    public function clusterGetServerStatus(array $parameters = array())
    {
        $this->request->setAction($this->apiFactory->factory('clusterGetServerStatus', $parameters));

        return $this->request->send();
    }

    /**
     * <b>The clusterRemoveServer Method</b>
     *
     * <pre>This method removes a server from the cluster. The removal process
     * may be asynchronous if Session Clustering is used. If this is the case,
     * the initial operation will return an HTTP 202 response. As long as
     * the server is not fully removed, further calls to remove the same server
     * should be idempotent. On a Zend Server Cluster Manager with no valid license,
     * this operation fails.</pre>
     *
     * @param int     $serverId <p>The id of the server to remove</p>
     * @param boolean $force    <p>Force-remove the server, skipping
     * graceful shutdown process. Default is FALSE</p>
     * @return \ZendService\ZendServerAPI\DataTypes\ServerInfo
     */
    public function clusterRemoveServer($serverId, $force = false)
    {
        $this->request->setAction($this->apiFactory->factory('clusterRemoveServer', $serverId, $force));

        return $this->request->send();
    }

    /**
     * <b>The clusterAddServer Method</b>
     *
     * <pre>Add a new server to the cluster. On a Zend Server Cluster Manager
     * with no valid license, this operation fails.</pre>
     *
     * @param string  $serverName        <p>The server name.</p>
     * @param string  $serverUrl         <p>The server address as a full HTTP/HTTPS URL.</p>
     * @param string  $guiPassword       <p>The server GUI password.</p>
     * @param boolean $propagateSettings <p>Propagate this server’s current settings
     * to the rest of the cluster. The default value is "FALSE".</p>
     * @return \ZendService\ZendServerAPI\DataTypes\ServerInfo
     */
    public function clusterAddServer($serverName, $serverUrl, $guiPassword, $propagateSettings = false)
    {
        $this->request->setAction($this->apiFactory->factory('clusterAddServer', $serverName, $serverUrl, $guiPassword, $propagateSettings));

        return $this->request->send();
    }

    /**
     * <b>The clusterDisableServer Method</b>
     *
     * <pre>This method disables a cluster member. This process may be asynchronous
     * if Session Clustering is used. If this is the case, the initial operation
     * returns an HTTP 202 response. As long as the server is not fully disabled,
     * further calls to this method are idempotent. On a Zend Server Cluster Manager
     * with no valid license, this operation fails.</pre>
     *
     * @param  int  $serverId <p>The server ID</p>
     * @return \ZendService\ZendServerAPI\DataTypes\ServerInfo
     */
    public function clusterDisableServer($serverId)
    {
        $this->request->setAction($this->apiFactory->factory('clusterDisableServer', $serverId));

        return $this->request->send();
    }

    /**
     * <b>The clusterEnableServer Method</b>
     *
     * <pre>This method is used to re-enable a cluster member. This process may be
     * asynchronous if Session Clustering is used. If this is the case, the initial
     * operation will return an HTTP 202 response. This action is idempotent,
     * and running it on an enabled server will result in a 200 OK response with
     * no consequences. On a Zend Server Cluster Manager with no valid license
     * this operation fails.</pre>
     *
     * @param  int  $serverId <p>The server ID</p>
     * @return \ZendService\ZendServerAPI\DataTypes\ServerInfo
     */
    public function clusterEnableServer($serverId)
    {
        $this->request->setAction($this->apiFactory->factory('clusterEnableServer', $serverId));

        return $this->request->send();
    }

    /**
     * <b>The restartPHP Method</b>
     *
     * <pre>This method restarts PHP on all servers or on specified servers in the cluster.
     * A 202 response in this case does not always indicate a successful restart of all servers.
     * Use the clusterGetServerStatus command to check the server(s) status again after a few seconds.</pre>
     *
     * @param array $serverIds <p>A list of server IDs to restart. If not specified,
     * all servers in the cluster will be restarted. In a single Zend Server context
     * this parameter is ignored.</p>
     * @param boolean $parallelRestart <p>Sends the restart command to all servers at the same time.
     * The default value is "FALSE".</p>
     * @return \ZendService\ZendServerAPI\DataTypes\ServersList
     */
    public function restartPhp($serverIds = array(), $parallelRestart = false)
    {
        $this->request->setAction($this->apiFactory->factory('restartPHP', $serverIds, $parallelRestart));

        return $this->request->send();
    }

    /**
     * <b>The clusterReconfigureServer Method</b>
     *
     * <pre>Re-configure a cluster member to match the cluster's profile.
     * This operation will fail on a Zend Server Cluster Manager with no valid license.</pre>
     *
     * @param int     $serverId  <p>The server ID.</p>
     * @param boolean $doRestart <p><b>This parameter take no effect anymore</b>
     * Specify if the re-configured server should
     * be restarted after the re-configure action. The default is FALSE.</p>
     * @return \ZendService\ZendServerAPI\DataTypes\ServerInfo
     */
    public function clusterReconfigureServer($serverId, $doRestart = false)
    {
        $this->request->setAction($this->apiFactory->factory('clusterReconfigureServer', $serverId, $doRestart));

        return $this->request->send();
    }

    /**
     * <pre>Wait for status = OK on $server, check every $interval seconds</pre>
     *
     * @param  string|int  $server   <p>Servername or server id</p>
     * @param  int         $interval <p>Seconds to repeat test</p>
     * @return \ZendService\ZendServerAPI\DataTypes\ServerInfo
     */
    public function waitForStableState($server, $interval = 5)
    {
        $serversList = $this->clusterGetServerStatus();
        $i = 0;

        if (is_string($server)) {
            $serverInfo = $serversList->getServerStatusByName($server);
            $serverId = $serverInfo->getId();
        } elseif (is_int($server)) {
            $serverInfo = $serversList->getServerStatusById($server);
            $serverId = $server;
        }

        while ($serverInfo->getStatus() !== "OK") {
            if($i++ == self::DEFAULT_WAITINTERVAL)
                break;

            $serversList = $this->clusterGetServerStatus(array($serverId));
            $serverInfo = $serversList->getServerStatusById($serverId);
            sleep($interval);
        }

        return $serverInfo;
    }

}
