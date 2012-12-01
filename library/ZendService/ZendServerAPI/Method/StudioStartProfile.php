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
 * <b>Method studioStartProfile Method</b>
 *
 * <pre>Start a profiling session with Zend Studio's integration
 * using an event-group's identifier.</pre>
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package ZendServerAPI\Method
 */
class StudioStartProfile extends Method
{
    /**
     * Events group identifier
     * @var string
     */
    protected $eventsGroupId = null;
    /**
     * Override the host address sent to Zend Server for
     * initiating a Debug session. This is used to point Zend
     * Server at the right address where Studio is executed
     * @var boolean
     */
    protected $overrideHost = null;

    /**
     * Constructor for studioStartDebug method
     *
     * @param string      $eventsGroupId Events group ID
     * @param string|null $overrideHost  Override the host address sent to Zend Server
     */
    public function __construct($eventsGroupId, $overrideHost = null)
    {
        $this->eventsGroupId = $eventsGroupId;
        if($overrideHost === null)
            $this->overrideHost = "127.0.0.1";
        else
            $this->overrideHost = $overrideHost;

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
        $this->setFunctionPath('/ZendServerManager/Api/studioStartProfile');
        $this->setParser(new \ZendServerAPI\Adapter\DebugRequest());
    }

    /**
     * Returns the accept header
     *
     * @return string
     */
    public function getAcceptHeader()
    {
        return "application/vnd.zend.serverapi+xml;version=1.2";
    }

    /**
     * Content for POST request
     *
     * @return string
     */
    public function getContent()
    {
        return "eventGroupId=".$this->eventsGroupId.
            "&overrideHost=".$this->overrideHost;
    }
}
