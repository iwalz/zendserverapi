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
 * Event model implementation.
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 */
class Event
{
    /**
     * Issue type name
     * @var string
     */
    protected $type = null;
    /**
     * Free text field with detail about the issue
     * @var string
     */
    protected $description = null;
    /**
     * Super globals array and their values:
     * get,post,cookie,session,server
     * @var \ZendServerAPI\DataTypes\SuperGlobals
     */
    protected $superglobals = null;
    /**
     * Url for the debugging event
     * @var string
     */
    protected $debugUrl = null;
    /**
     * Severity indicator for the event:
     * Info, Warning, Critical
     * @var string
     */
    protected $severity = null;
    /**
     * A list of backtrace step elements
     * @var array
     */
    protected $backtraces = array();
    /**
     * The events group identifier
     * @var Integer
     */
    protected $eventsGroupId = null;

    /**
     * Get the type
     *
     * @return string
     */
    public function getType ()
    {
        return $this->type;
    }

    /**
     * Get the free form text field with
     * details about the issue
     *
     * @return string
     */
    public function getDescription ()
    {
        return $this->description;
    }

    /**
     * Get the superglobals
     *
     * @return \ZendServerAPI\DataTypes\SuperGlobals
     */
    public function getSuperglobals ()
    {
        return $this->superglobals;
    }

    /**
     * Get the URL for debugging event
     *
     * @return string
     */
    public function getDebugUrl ()
    {
        return $this->debugUrl;
    }

    /**
     * Get the severity
     *
     * @return string
     */
    public function getSeverity ()
    {
        return $this->severity;
    }

    /**
     * Get an array of \ZendServerAPI\DataTypes\Step
     * objects
     *
     * @return array
     */
    public function getBacktraces ()
    {
        return $this->backtraces;
    }

    /**
     * Set the issue type name
     *
     * @param string
     * @return void
     */
    public function setType ($type)
    {
        $this->type = $type;
    }

    /**
     * Set the description
     *
     * @param string
     * @return void
     */
    public function setDescription ($description)
    {
        $this->description = $description;
    }

    /**
     * Set the superglobals
     *
     * @param  \ZendServerAPI\DataTypes\SuperGlobals $superglobals
     * @return void
     */
    public function setSuperglobals (\ZendServerAPI\DataTypes\SuperGlobals $superglobals)
    {
        $this->superglobals = $superglobals;
    }

    /**
     * Set the URL of the debug event
     *
     * @param  string $debugUrl
     * @return void
     */
    public function setDebugUrl ($debugUrl)
    {
        $this->debugUrl = $debugUrl;
    }

    /**
     * Set the severity
     *
     * @param  string $severity
     * @return void
     */
    public function setSeverity ($severity)
    {
        $this->severity = $severity;
    }

    /**
     * Add a step to the $backtraces array
     *
     * @param \ZendServerAPI\DataTypes\Step $step
     * @return void
     */
    public function addStep (\ZendServerAPI\DataTypes\Step $step)
    {
        $this->backtraces[] = $step;
    }

    /**
     * Get the events group identifier
     *
     * @return int
     */
    public function getEventsGroupId ()
    {
        return $this->eventsGroupId;
    }

    /**
     * Set the events group identifier
     *
     * @param  int  $eventsGroupId
     * @return void
     */
    public function setEventsGroupId ($eventsGroupId)
    {
        $this->eventsGroupId = (int) $eventsGroupId;
    }

}
