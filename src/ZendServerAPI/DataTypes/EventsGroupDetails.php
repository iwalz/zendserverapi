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

class EventsGroupDetails
{
    /**
     * The issue ID
     * @var Integer
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

    public function __construct()
    {

    }
    /**
     * @return the $issueId
     */
    public function getIssueId ()
    {
        return $this->issueId;
    }

    /**
     * @return the $eventsGroup
     */
    public function getEventsGroup ()
    {
        return $this->eventsGroup;
    }

    /**
     * @return the $event
     */
    public function getEvent ()
    {
        return $this->event;
    }

    /**
     * @return the $codeTracing
     */
    public function getCodeTracing ()
    {
        return $this->codeTracing;
    }

    /**
     * @param NULL $issueId
     */
    public function setIssueId ($issueId)
    {
        $this->issueId = $issueId;
    }

    /**
     * @param NULL $eventsGroup
     */
    public function setEventsGroup (\ZendServerAPI\DataTypes\EventsGroup $eventsGroup)
    {
        $this->eventsGroup = $eventsGroup;
    }

    /**
     * @param NULL $event
     */
    public function setEvent (\ZendServerAPI\DataTypes\Event $event)
    {
        $this->event = $event;
    }

    /**
     * @param NULL $codeTracing
     */
    public function setCodeTracing ($codeTracing)
    {
        $this->codeTracing = $codeTracing;
    }

}
