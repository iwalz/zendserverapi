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

class ApplicationSynchronize extends \ZendServerAPI\Method
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
     * @param int $applicationId ApplicationId to remove
     */
    public function __construct($applicationId, array $servers = array(), $ignoreFailures = false)
    {
        $this->applicationId = $applicationId;
        $this->servers = $servers;
        $this->ignoreFailures = $ignoreFailures;
        parent::__construct();
    }

    /**
     * @see \ZendServerAPI\Method::configure()
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
