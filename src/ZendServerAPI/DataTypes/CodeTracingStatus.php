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

namespace ZendServerAPI\DataTypes;

/**
 * CodeTracingStatus model implementation.
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 */
class CodeTracingStatus extends DataType
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

    /**
     * Get the current activity status of the component:
     * Active | Inactive
     *
     * @return string
     */
    public function getComponentStatus ()
    {
        return $this->componentStatus;
    }

    /**
     * Get the current always_dump directive value (On|Off)
     *
     * @return string
     */
    public function getAlwaysDump ()
    {
        return $this->alwaysDump;
    }

    /**
     * Get the trace enabled directive value
     * ( On | Off )
     *
     * @return string
     */
    public function getTraceEnabled ()
    {
        return $this->traceEnabled;
    }

    /**
     * If "true", ZendServer is waiting for a restart which may
     * affect these settings
     *
     * @return string
     */
    public function getAwaitsRestart ()
    {
        return $this->awaitsRestart;
    }

    /**
     * Set the component status
     *
     * @param  string $componentStatus
     * @return void
     */
    public function setComponentStatus ($componentStatus)
    {
        $this->componentStatus = $componentStatus;
    }

    /**
     * Set the always dump setting
     *
     * @param  string $alwaysDump
     * @return void
     */
    public function setAlwaysDump ($alwaysDump)
    {
        $this->alwaysDump = $alwaysDump;
    }

    /**
     * Set the trace enabled setting
     *
     * @param  string $traceEnabled
     * @return void
     */
    public function setTraceEnabled ($traceEnabled)
    {
        $this->traceEnabled = $traceEnabled;
    }

    /**
     * Set the awaits restart setting
     *
     * @param  string $awaitsRestart
     * @return void
     */
    public function setAwaitsRestart ($awaitsRestart)
    {
        $this->awaitsRestart = $awaitsRestart;
    }

    /**
     * Get the developerMode
     *
     * @return string
     */
    public function getDeveloperMode ()
    {
        return $this->developerMode;
    }

    /**
     * Set the developermode
     *
     * @param  string $developerMode
     * @return void
     */
    public function setDeveloperMode ($developerMode)
    {
        $this->developerMode = $developerMode;
    }

}
