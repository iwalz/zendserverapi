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

namespace ZendServerAPI\Method;

class MonitorGetIssuesListByPredefinedFilter extends \ZendServerAPI\Method
{
    /**
     * The predefined filter's id. Can be the filter's “name” or the
     * actual identifier randomly created by the system. This
     * parameter is case-sensitive
     * @var string
     */
    protected $filterId = null;
    /**
     * The number of rows to retrieve. Default lists all events up
     * to an arbitrary limit set by the system
     * @var Integer
     */
    protected $limit = null;
    /**
     * A paging offset to begin the issues list from. Default is 0
     * @var Integer
     */
    protected $offset = null;
    /**
     * Column identifier for sorting the result set (id, repeats,
     * date, eventType, fullUrl, severity, status). Default is date
     * @var string
     */
    protected $order = null;
    /**
     * Sorting direction: Ascending or Descending. Default is
     * Descending
     * @var string
     */
    protected $direction = null;

    /**
     * Constructor of method MonitorGetIssuesListByPredefinedFilter
     *
     * Retrieve a list of monitor issues according to a preset filter identifier.
     * The filter identifier is shared with the UI's predefined filters.
     * This WebAPI method may also accept ordering details and paging limits.
     * The response is a list of issue elements with their general details and event-groups identifiers.
     *
     * @param  string                                                       $filterId  The predefined filter's id
     * @param  Integer|null                                                 $limit     The number of rows to retrieve
     * @param  Integer|null                                                 $offset    A paging offset to begin the issues list from
     * @param  string|null                                                  $order     Column identifier for sorting the result set
     * @param  string|null                                                  $direction Sorting direction: Ascending or Descending
     * @return \ZendServerAPI\Method\MonitorGetIssuesListByPredefinedFilter
     */
    public function __construct($filterId, $limit = null, $offset = null, $order = null, $direction = null)
    {
        $this->filterId = $filterId;
        $this->limit = $limit;
        $this->offset = $offset;
        $this->order = $order;
        $this->direction = $direction;
        parent::__construct();
    }

    /**
     * @see \ZendServerAPI\Method::configure()
     */
    public function configure ()
    {
        $this->setMethod('GET');
        $this->setFunctionPath('/ZendServerManager/Api/monitorGetIssuesListPredefinedFilter');
        $this->setParser(new \ZendServerAPI\Adapter\IssueList());
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
        $link .= "?filterId=".urlencode($this->filterId);
        $link .= "&limit=".$this->limit;
        $link .= "&order=".$this->order;
        $link .= "&offset=".$this->offset;
        $link .= "&direction=".$this->direction;

        return $link;
    }
}
