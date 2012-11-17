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
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TOR
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
 * <b>The clusterEnableServer Method</b>
 *
 * <pre>This method is used to re-enable a cluster member. 
 * This process may be asynchronous if Session Clustering is used. 
 * If this is the case, the initial operation will return an HTTP 202 response. 
 * This action is idempotent, and running it on an enabled server will result 
 * in a 200 OK response with no consequences. 
 * On a Zend Server Cluster Manager with no valid license this operation fails.</pre>
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package ZendServerAPI\Method
 */
class ClusterEnableServer extends \ZendServerAPI\Method
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
        $this->setParser(new \ZendServerAPI\Adapter\ServerInfo());
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
