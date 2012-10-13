<?php
/*
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

namespace ZendServerAPI;

class Studio extends BaseAPI
{
    /**
     * The studioStartDebug Method
     *
     * Start a debug session for a specific issue
     *
     * @param  string                                $eventsGroupId Events group ID
     * @param  string                                $noRemote      Use server's own local files for debug display
     * @param  string                                $overrideHost  Override the host address sent to Zend Server
     * @return \ZendServerAPI\DataTypes\DebugRequest
     */
    public function studioStartDebug($eventsGroupId, $noRemote = null, $overrideHost = null)
    {
        $this->request->setAction($this->apiFactory->factory('studioStartDebug', $eventsGroupId, $noRemote, $overrideHost));

        return $this->request->send();
    }

    /**
     * The studioStartProfile Method
     *
     * Start a profiling session with Zend Studio's integration
     * using an events group identifier
     *
     * @param  string                                $eventsGroupId Events group ID
     * @param  string                                $overrideHost  Override the host address sent to Zend Server
     * @return \ZendServerAPI\DataTypes\DebugRequest
     */
    public function studioStartProfile($eventsGroupId, $overrideHost = null)
    {
        $this->request->setAction($this->apiFactory->factory('studioStartProfile', $eventsGroupId, $overrideHost));

        return $this->request->send();
    }

}
