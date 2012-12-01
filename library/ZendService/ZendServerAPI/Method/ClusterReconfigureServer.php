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
 * @package     ZendService\ZendServerAPI\Method
 */

namespace ZendService\ZendServerAPI\Method;

/**
 * <b>The clusterReconfigureServer Method</b>
 *
 * <pre>Re-configure a cluster member to match the cluster's profile.
 * This operation will fail on a Zend Server Cluster Manager with
 * no valid license.</pre>
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package ZendService\ZendServerAPI\Method
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
     * Constructor for ClusterReconfigureServer method
     *
     * @param int $server ServerId to reconfigure
     * @param boolean restart server after action
     */
    public function __construct($server, $doRestart = false)
    {
        $this->server = $server;
        $this->doRestart = $doRestart;
        parent::__construct();
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
