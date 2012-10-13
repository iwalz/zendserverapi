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

class IssueDetails
{
    /**
     * The issue
     * @var \ZendServerAPI\DataTypes\Issue
     */
    protected $issue = null;
    /**
     * The event Group
     * @var array
     */
    protected $eventsGroups = array();

    public function __construct()
    {

    }
    /**
     * @return the $issue
     */
    public function getIssue ()
    {
        return $this->issue;
    }

    /**
     * @return the $eventsGroups
     */
    public function getEventsGroups ()
    {
        return $this->eventsGroups;
    }

    /**
     * @param \ZendServerAPI\DataTypes\Issue $issue
     */
    public function setIssue (\ZendServerAPI\DataTypes\Issue $issue)
    {
        $this->issue = $issue;
    }

    /**
     * @param \ZendServerAPI\DataTypes\EventsGroup $eventsGroup
     */
    public function addEventsGroup (\ZendServerAPI\DataTypes\EventsGroup $eventsGroup)
    {
        $this->eventsGroups[] = $eventsGroup;
    }

}
