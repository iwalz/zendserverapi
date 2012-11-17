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
 * <b>The clusterAddServer Method</b>
 *
 * <pre>Add a new server to the cluster. On a Zend Server Cluster Manager 
 * with no valid license, this operation fails.</pre>
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 */
class ClusterAddServer extends \ZendServerAPI\Method
{
    /**
     * Name of server to add
     * @var string
     */
    private $serverName = null;
    /**
     * Url to server gui e.g. http://192.168.1.5:10081/ZendServer
     * @var string
     */
    private $serverUrl = null;
    /**
     * Password for zend server gui
     * @var string
     */
    private $guiPassword = null;
    /**
     * Use this server as master for the rest
     * @var boolean
     */
    private $propagateSettings = null;
    /**
     * Restart after this action
     * @var boolean
     */
    private $doRestart = null;

    /**
     * Constructor of method ClusterAddServer
     *
     * @param string  $serverName        Name of server to add
     * @param string  $serverUrl         Url of server e.g. http://192.168.1.5:10081/ZendServer
     * @param string  $guiPassword       Password for gui
     * @param boolean $propagateSettings Propagate this servers config to the cluster
     * @param boolean $doRestart         Automatically restart after config changes during the add
     */
    public function __construct($serverName, $serverUrl, $guiPassword, $propagateSettings = false, $doRestart = false)
    {
        $this->serverName = $serverName;
        $this->serverUrl = $serverUrl;
        $this->guiPassword = $guiPassword;
        $this->propagateSettings = $propagateSettings;
        $this->doRestart = $doRestart;
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
        $this->setFunctionPath('/ZendServerManager/Api/clusterAddServer');
        $this->setParser(new \ZendServerAPI\Adapter\ServerInfo());
    }

    /**
     * Get content for POST body
     *
     * @return string
     */
    public function getContent()
    {
        return
            "serverName=".$this->serverName."&".
            "serverUrl=".$this->serverUrl."&".
            "guiPassword=".$this->guiPassword."&".
            "propagateSettings=".($this->propagateSettings === true ? 'TRUE' : 'FALSE')."&".
            "doRestart=".($this->doRestart === true ? 'TRUE' : 'FALSE');
    }
}
