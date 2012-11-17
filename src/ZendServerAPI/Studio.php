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
 * @package     ZendServerAPI
 */

namespace ZendServerAPI;

/**
 * <b>Studio-Integration Methods</b>
 *
 * The following is a list of methods available for the Studio-Integration feature:
 *
 * <ul>
 * <li>studioStartDebug</li>
 * <li>studioStartProfile</li>
 * </ul>
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendServerAPI
 */
class Studio extends BaseAPI
{
    /**
     * <b>The studioStartDebug Method</b>
     *
     * <pre>Start a debug session for a specific issue</pre>
     *
     * @param string $eventsGroupId <p>The issue event group identifier</p>
     * @param string $noRemote      <p>Use server's own local files for debug display.
     * Default: true. Setting to false will use local files from studio if available</p>
     * @param string $overrideHost <p>Override the host address sent to Zend Server for
     * initiating a Debug session. This is used to point Zend Server at the right address
     * where Studio is executed</p>
     * @return \ZendServerAPI\DataTypes\DebugRequest
     */
    public function studioStartDebug($eventsGroupId, $noRemote = null, $overrideHost = null)
    {
        $this->request->setAction($this->apiFactory->factory('studioStartDebug', $eventsGroupId, $noRemote, $overrideHost));

        return $this->request->send();
    }

    /**
     * <b>The studioStartProfile Method</b>
     *
     * <pre>Start a profiling session with Zend Studio's integration
     * using an events group identifier</pre>
     *
     * @param string $eventsGroupId <p>The issue event group identifier</p>
     * @param string $overrideHost  <p>Override the host address sent to
     * Zend Server for initiating a Debug session. This is used to point Zend Server
     * at the right address where Studio is executed</p>
     * @return \ZendServerAPI\DataTypes\DebugRequest
     */
    public function studioStartProfile($eventsGroupId, $overrideHost = null)
    {
        $this->request->setAction($this->apiFactory->factory('studioStartProfile', $eventsGroupId, $overrideHost));

        return $this->request->send();
    }

}
