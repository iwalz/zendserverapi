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
 * <b>The applicationSynchronize Method</b>
 *
 * <pre>Synchronizing an existing application, whether in order to fix a problem
 * or to reset an installation. This process is asynchronous, meaning the initial
 * request will start the synchronize process and the initial response will show
 * information about the application being synchronized. However, the synchronize
 * process will proceed after the response is returned. You must continue checking
 * the application status using the applicationGetStatus method until the process
 * is complete.</pre>
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package ZendServerAPI\Method
 */
class ApplicationSynchronize extends Method
{
    /**
     * ApplicationId to sync
     * @var int
     */
    protected $applicationId = null;
    /**
     * Array of server IDs
     * @var array
     */
    protected $servers = array();
    /**
     * Ignore failures
     * @var boolean
     */
    protected $ignoreFailures = null;

    /**
     * Constructor for ApplicationRemove method
     *
     * @param int   $applicationId ApplicationId to remove
     * @param array $servers
     * <p>A List of server ID's. If defined, the action will be done
     * only on the servers whose ID's are specified and which
     * are currently members of the cluster.</p>
     * @param bool $ignoreFailures
     * <p>Ignore failures during staging or activation if only some
     * servers report failures. If all servers report failures the
     * operation will fail in any case. The default value is FALSE,
     * meaning any failure will return an error.</p>
     */
    public function __construct($applicationId, array $servers = array(), $ignoreFailures = false)
    {
        $this->applicationId = $applicationId;
        $this->servers = $servers;
        $this->ignoreFailures = $ignoreFailures;
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
        $this->setFunctionPath('/ZendServerManager/Api/applicationSynchronize');
        $this->setParser(new \ZendServerAPI\Adapter\ApplicationInfo());
    }

    /**
     * Content for POST request
     *
     * @return string
     */
    public function getContent()
    {
        $content = "appId=".$this->applicationId;

        $content .= "&ignoreFailures=".($this->ignoreFailures == true ? 'TRUE' : 'FALSE');

        if (count($this->servers) > 0) {
            foreach ($this->servers as $index => $server) {
                $content .= "&".urlencode("servers[".$index."]")."=".$server;
                if($index+1 < count($this->servers))
                    $content .= "&";
            }
        }

        return $content;
    }

}
