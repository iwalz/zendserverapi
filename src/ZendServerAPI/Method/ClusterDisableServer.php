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
 * @package     ZendServerAPI\Method
 */

namespace ZendServerAPI\Method;

/**
 * <b>The clusterDisableServer Method</b>
 *
 * <pre>This method disables a cluster member. This process may be
 * asynchronous if Session Clustering is used. If this is the case,
 * the initial operation returns an HTTP 202 response. As long as the server is not
 * fully disabled, further calls to this method are idempotent. On a
 * Zend Server Cluster Manager with no valid license, this operation fails.</pre>
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package ZendServerAPI\Method
 */
class ClusterDisableServer extends \ZendServerAPI\Method
{
    /**
     * Parameter for ClusterDisableServer method
     * @var int
     */
    private $serverId = null;

    /**
     * Constructor for ClusterDisableServer method
     *
     * @param int $serverId Id of the server to disable
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
        $this->setFunctionPath('/ZendServerManager/Api/clusterDisableServer');
        $this->setParser(new \ZendServerAPI\Adapter\ServerInfo());
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
