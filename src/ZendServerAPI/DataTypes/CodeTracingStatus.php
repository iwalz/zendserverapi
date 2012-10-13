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

namespace ZendServerAPI\DataTypes;

class CodeTracingStatus
{
    /**
     * Current activity status
     * @var string
     */
    protected $componentStatus = null;
    /**
     * Current always_dump directive value (On|Off)
     * @var boolean
     */
    protected $alwaysDump = null;
    /**
     * Current trace_enabled directive value (On|Off)
     * @var boolean
     */
    protected $traceEnabled = null;
    /**
     * If true, ZendServer is waiting for a restart
     * which may effect these setting
     * @var boolean
     */
    protected $awaitsRestart = null;
    /**
     * Undocumented parameter
     * @var boolean
     */
    protected $developerMode = null;

    public function __construct()
    {

    }
    /**
     * @return the $componentStatus
     */
    public function getComponentStatus ()
    {
        return $this->componentStatus;
    }

    /**
     * @return the $alwaysDump
     */
    public function getAlwaysDump ()
    {
        return $this->alwaysDump;
    }

    /**
     * @return the $traceEnabled
     */
    public function getTraceEnabled ()
    {
        return $this->traceEnabled;
    }

    /**
     * @return the $awaitsRestart
     */
    public function getAwaitsRestart ()
    {
        return $this->awaitsRestart;
    }

    /**
     * @param NULL $componentStatus
     */
    public function setComponentStatus ($componentStatus)
    {
        $this->componentStatus = $componentStatus;
    }

    /**
     * @param NULL $alwaysDump
     */
    public function setAlwaysDump ($alwaysDump)
    {
        $this->alwaysDump = $alwaysDump;
    }

    /**
     * @param NULL $traceEnabled
     */
    public function setTraceEnabled ($traceEnabled)
    {
        $this->traceEnabled = $traceEnabled;
    }

    /**
     * @param NULL $awaitsRestart
     */
    public function setAwaitsRestart ($awaitsRestart)
    {
        $this->awaitsRestart = $awaitsRestart;
    }
    /**
     * @return the $developerMode
     */
    public function getDeveloperMode ()
    {
        return $this->developerMode;
    }

    /**
     * @param boolean $developerMode
     */
    public function setDeveloperMode ($developerMode)
    {
        $this->developerMode = $developerMode;
    }

}
