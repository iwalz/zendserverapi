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
 * eventsGroupDetails
 *
 * Details about an issue's eventsGroup, including the actual event data.
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 */
class EventsGroupDetails extends DataType
{
    /**
     * The issue ID
     * @var int
     */
    protected $issueId = null;
    /**
     * Basic detail about the events group
     * @var \ZendServerAPI\DataTypes\EventsGroup
     */
    protected $eventsGroup = null;
    /**
     * Basic detail about the event group
     * @var \ZendServerAPI\DataTypes\Event
     */
    protected $event = null;
    /**
     * Associated code tracing identifier
     * @var string
     */
    protected $codeTracing = null;

    /**
     * Get the issue ID
     *
     * @return int
     */
    public function getIssueId ()
    {
        return $this->issueId;
    }

    /**
     * Get the basic detail about the events group
     *
     * @return \ZendServerAPI\DataTypes\EventsGroup
     */
    public function getEventsGroup ()
    {
        return $this->eventsGroup;
    }

    /**
     * Get the details about the event group
     *
     * @return \ZendServerAPI\DataTypes\Event
     */
    public function getEvent ()
    {
        return $this->event;
    }

    /**
     * Get the associated code tracing identifier
     *
     * @return string
     */
    public function getCodeTracing ()
    {
        return $this->codeTracing;
    }

    /**
     * Set the issue ID
     *
     * @param int
     * @return void
     */
    public function setIssueId ($issueId)
    {
        $this->issueId = (int) $issueId;
    }

    /**
     * Set the basic detail about the events group
     *
     * @param  \ZendServerAPI\DataTypes\EventsGroup $eventsGroup
     * @return void
     */
    public function setEventsGroup (\ZendServerAPI\DataTypes\EventsGroup $eventsGroup)
    {
        $this->eventsGroup = $eventsGroup;
    }

    /**
     * Set the details about the event group
     *
     * @param  \ZendServerAPI\DataTypes\Event $event
     * @return void
     */
    public function setEvent (\ZendServerAPI\DataTypes\Event $event)
    {
        $this->event = $event;
    }

    /**
     * Set the associated code tracing identifier
     *
     * @param  string $codeTracing
     * @return void
     */
    public function setCodeTracing ($codeTracing)
    {
        $this->codeTracing = $codeTracing;
    }

}
