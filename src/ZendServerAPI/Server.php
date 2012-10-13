<?php
/*
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
 */

namespace ZendServerAPI;

class Server extends BaseAPI
{
    /**
     * PHP function for 'getSystemInfo' API call
     *
     * @access public
     * @return \ZendServerAPI\DataTypes\SystemInfo
     */
    public function getSystemInfo()
    {
        $this->request->setAction($this->apiFactory->factory('getSystemInfo'));

        return $this->request->send();
    }

    /**
     * PHP function for 'ClusterGetServerStatus' API call
     *
     * @access public
     * @param  array                                $parameters Array of server ids
     * @return \ZendServerAPI\DataTypes\ServersList
     */
    public function clusterGetServerStatus(array $parameters = array())
    {
        $this->request->setAction($this->apiFactory->factory('clusterGetServerStatus', $parameters));

        return $this->request->send();
    }

    /**
     * PHP function for 'ClusterRemoveServer' API call
     *
     * @access public
     * @param  int                                 $serverId The id of the server to remove
     * @param  boolean                             $force    Skip graceful shutdown
     * @return \ZendServerAPI\DataTypes\ServerInfo
     */
    public function clusterRemoveServer($serverId, $force = false)
    {
        $this->request->setAction($this->apiFactory->factory('clusterRemoveServer', $serverId, $force));

        return $this->request->send();
    }

    /**
     * PHP function for 'ClusterAddServer' API call
     *
     * @access public
     * @param  string                              $serverName        name of the server
     * @param  string                              $serverUrl         URL to server (e.g. 127.0.0.1:10081)
     * @param  string                              $guiPassword       password of Zend Server GUI
     * @param  boolean                             $propagateSettings
     * @return \ZendServerAPI\DataTypes\ServerInfo
     */
    public function clusterAddServer($serverName, $serverUrl, $guiPassword, $propagateSettings = false)
    {
        $this->request->setAction($this->apiFactory->factory('clusterAddServer', $serverName, $serverUrl, $guiPassword, $propagateSettings));

        return $this->request->send();
    }

    /**
     * PHP function for 'ClusterDisableServer' API call
     *
     * @access public
     * @param  int                                 $serverId The id of the server to disable
     * @return \ZendServerAPI\DataTypes\ServerInfo
     */
    public function clusterDisableServer($serverId)
    {
        $this->request->setAction($this->apiFactory->factory('clusterDisableServer', $serverId));

        return $this->request->send();
    }

    /**
     * PHP function for 'ClusterEnableServer' API call
     *
     * @access public
     * @param  int                                 $serverId The id of the server to enable
     * @return \ZendServerAPI\DataTypes\ServerInfo
     */
    public function clusterEnableServer($serverId)
    {
        $this->request->setAction($this->apiFactory->factory('clusterEnableServer', $serverId));

        return $this->request->send();
    }

    /**
     * PHP function for 'RestartPhp' API call
     *
     * @access public
     * @param array $serverIds The ids of the server to restart
     * @param boolean restart all servers in parallel
     * @return \ZendServerAPI\DataTypes\ServersList
     */
    public function restartPhp($serverIds = array(), $parallelRestart = false)
    {
        $this->request->setAction($this->apiFactory->factory('restartPHP', $serverIds, $parallelRestart));

        return $this->request->send();
    }

    /**
     * PHP function for 'ClusterReconfigureServer' API call
     *
     * @access public
     * @param int $serverId The id of the server to reconfigure
     * @param boolean restart server
     * @return \ZendServerAPI\DataTypes\ServerInfo
     */
    public function clusterReconfigureServer($serverId, $doRestart = false)
    {
        $this->request->setAction($this->apiFactory->factory('clusterReconfigureServer', $serverId, $doRestart));

        return $this->request->send();
    }

    /**
     * Wait for status = OK on $server, check every $interval seconds
     *
     * @param  string|int                          $server   Servername or server id
     * @param  int                                 $interval Seconds to repeat test
     * @return \ZendServerAPI\DataTypes\ServerInfo
     */
    public function waitForStableState($server, $interval = 5)
    {
        $serversList = $this->clusterGetServerStatus();
        if (is_string($server)) {
            $serverInfo = $serversList->getServerStatusByName($server);
            $serverId = $serverInfo->getId();
        } elseif (is_int($server)) {
            $serverInfo = $serversList->getServerStatusById($server);
            $serverId = $server;
        }

        while ($serverInfo->getStatus() !== "OK") {
            $serversList = $this->clusterGetServerStatus(array($serverId));
            $serverInfo = $serversList->getServerStatusById($serverId);
            sleep($interval*1000);
        }

        return $serverInfo;
    }

}
