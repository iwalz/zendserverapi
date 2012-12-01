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

namespace ZendService\ZendServerAPI\Method;

/**
 * <b>The restartPHP Method</b>
 *
 * <pre>This method restarts PHP on all servers or on specified servers in the cluster.
 * A 202 response in this case does not always indicate a successful restart of all servers.
 * Use the clusterGetServerStatus command to check the server(s) status again after a few seconds.</pre>
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package ZendServerAPI\Method
 */
class RestartPHP extends Method
{
    /**
     * ServerIds to restart
     * @var array
     */
    private $servers = null;
    /**
     * Restart servers in parallel
     * @var boolean
     */
    private $parallelRestart = null;

    /**
     * Constructor for RestartPhp method
     *
     * @param array $servers         ServerIds to restart
     * @param bool  $parallelRestart Restart all at the same time
     */
    public function __construct(array $servers = array(), $parallelRestart = false)
    {
        $this->servers = $servers;
        $this->parallelRestart = $parallelRestart;
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
        $this->setFunctionPath('/ZendServerManager/Api/restartPhp');
        $this->setParser(new \ZendServerAPI\Adapter\ServersList());
    }

    /**
     * Content for POST request
     *
     * @return string
     */
    public function getContent()
    {
        $content = "";
        $parameterCount = count($this->servers);

        foreach ($this->servers as $index => $server) {
            $content .= urlencode("servers[".$index."]")."=".$server;
            if($index+1 < $parameterCount)
                $content .= "&";
        }
        $content .= "&parallelRestart=".($this->parallelRestart === true ? 'TRUE' : 'FALSE');

        return $content;
    }

}
