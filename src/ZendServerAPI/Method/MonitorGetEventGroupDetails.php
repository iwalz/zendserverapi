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

namespace ZendServerAPI\Method;

class MonitorGetEventGroupDetails extends \ZendServerAPI\Method
{
    /**
     * The issue ID of the issue to get the details for
     * @var string
     */
    protected $issueId = null;
    protected $eventsGroupId = null;

    /**
     * Constructor of method MonitorGetEventGroupDetails
     *
     * Retrieves the details of the given issue id.
     *
     * @param  string                                            $issueId      The issue ID
     * @param  Integer                                           $eventGroupId The event group identifier
     * @return \ZendServerAPI\Method\MonitorGetEventGroupDetails
     */
    public function __construct($issueId, $eventsGroupId)
    {
        $this->issueId = $issueId;

        $this->eventsGroupId = $eventsGroupId;
        parent::__construct();
    }

    /**
     * @see \ZendServerAPI\Method::configure()
     */
    public function configure ()
    {
        $this->setMethod('GET');
        $this->setFunctionPath('/ZendServerManager/Api/monitorGetEventGroupDetails');
        $this->setParser(new \ZendServerAPI\Adapter\EventsGroupDetails());
    }

    public function getAcceptHeader()
    {
        return "application/vnd.zend.serverapi+xml;version=1.2";
    }

    /**
     * @see \ZendServerAPI\Method::getLink()
     */
    public function getLink()
    {
        $link = $this->getFunctionPath();
        $link .= "?issueId=".$this->issueId;
        $link .= "&eventGroupId=".$this->eventsGroupId;

        return $link;
    }
}
