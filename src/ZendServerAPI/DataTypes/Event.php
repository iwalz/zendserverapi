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

    public function __construct()
    {

    }
    /**
     * @return the $type
     */
    public function getType ()
    {
        return $this->type;
    }

    /**
     * @return the $description
     */
    public function getDescription ()
    {
        return $this->description;
    }

    /**
     * @return the $superglobals
     */
    public function getSuperglobals ()
    {
        return $this->superglobals;
    }

    /**
     * @return the $debugUrl
     */
    public function getDebugUrl ()
    {
        return $this->debugUrl;
    }

    /**
     * @return the $severity
     */
    public function getSeverity ()
    {
        return $this->severity;
    }

    /**
     * @return the $backtraces
     */
    public function getBacktraces ()
    {
        return $this->backtraces;
    }

    /**
     * @param string $type
     */
    public function setType ($type)
    {
        $this->type = $type;
    }

    /**
     * @param string $description
     */
    public function setDescription ($description)
    {
        $this->description = $description;
    }

    /**
     * @param \ZendServerAPI\DataTypes\SuperGlobals $superglobals
     */
    public function setSuperglobals (\ZendServerAPI\DataTypes\SuperGlobals $superglobals)
    {
        $this->superglobals = $superglobals;
    }

    /**
     * @param string $debugUrl
     */
    public function setDebugUrl ($debugUrl)
    {
        $this->debugUrl = $debugUrl;
    }

    /**
     * @param string $severity
     */
    public function setSeverity ($severity)
    {
        $this->severity = $severity;
    }

    /**
     * @param multitype: $backtraces
     */
    public function addStep (\ZendServerAPI\DataTypes\Step $step)
    {
        $this->backtraces[] = $step;
    }
    /**
     * @return the $eventsGroupId
     */
    public function getEventsGroupId ()
    {
        return $this->eventsGroupId;
    }

    /**
     * @param number $eventsGroupId
     */
    public function setEventsGroupId ($eventsGroupId)
    {
        $this->eventsGroupId = $eventsGroupId;
    }

}
