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
 */

namespace ZendServerAPI\Method;
use ZendServerAPI\DataTypes\ServersList,
    ZendServerAPI\DataTypes\ServerInfo,
    ZendServerAPI\DataTypes\MessageList;

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
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 */
class ClusterGetServerStatus  extends \ZendServerAPI\Method
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
        $this->setParser(new \ZendServerAPI\Adapter\ServersList());
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
