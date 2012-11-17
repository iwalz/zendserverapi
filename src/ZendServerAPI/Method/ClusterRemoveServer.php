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
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 */
class ClusterRemoveServer extends \ZendServerAPI\Method
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
     * @param int $server ServerId to remove
     * @param bool $force Force remove
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
        $this->setParser(new \ZendServerAPI\Adapter\ServerInfo());
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
