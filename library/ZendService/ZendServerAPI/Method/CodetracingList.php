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
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendServerAPI\Method
 */

namespace ZendService\ZendServerAPI\Method;

/**
 * <b>The codetracingList Method</b>
 *
 * <pre>Retrieve a list of code-tracing files available for download
 * using codetracingDownloadTraceFile.</pre>
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package ZendServerAPI\Method
 */
class CodetracingList extends Method
{
    /**
     * List of application IDs. If specified, code-tracing
     * entries will be returned for these applications only.
     * Default: all applications
     *
     * @var array
     */
    protected $applicationIds = null;
    /**
     * Row limit to retrieve, defaults to value defined in
     * zend-user-user.ini
     *
     * @var int
     */
    protected $limit = null;
    /**
     * The page offset to be displayed, defaults to 0
     *
     * @var int
     */
    protected $offset = null;
    /**
     * Column to sort the result by (Id, Date, Url, CreatedBy,
     * Filesize), defaults to Date
     *
     * @var string
     */
    protected $orderBy = null;
    /**
     * Sorting direction , defaults to Desc
     *
     * @var string
     */
    protected $direction = null;

    /**
     * Constructor for CodetracingList method
     *
     * @param array  $applicationIds Application ID
     * @param int    $limit          Limit to retrieve
     * @param int    $offset         Page offset
     * @param string $orderBy        Column to sort
     * @param string $direction      ASC or DESC
     */
    public function __construct($applicationIds = array(), $limit = null, $offset = null, $orderBy = null, $direction = null)
    {
        parent::__construct();

        $this->applicationIds = $applicationIds;
        $this->limit = $limit;
        $this->offset = $offset;
        $this->orderBy = $orderBy;
        $this->direction = $direction;
    }

    /**
     * Returns the codetracing accept header
     *
     * @return string
     */
    public function getAcceptHeader()
    {
        return "application/vnd.zend.serverapi+xml;version=1.2";
    }

    /**
     * Configures all needed information for the method implementation
     *
     * @return void
     */
    public function configure ()
    {
        $this->setMethod('GET');
        $this->setFunctionPath('/ZendServerManager/Api/codetracingList');
        $this->setParser(new \ZendServerAPI\Adapter\CodetracingList());
    }

    /**
     * Get link for the method
     *
     * @return string
     */
    public function getLink()
    {
        $link = parent::getLink();

        $link .= '?offset='.$this->offset;
        $link .= '&limit='.$this->limit;
        $link .= '&orderBy='.$this->orderBy;
        $link .= '&'.$this->buildParameterArray('applicationIds', $this->applicationIds);
        $link .= '&direction='.$this->direction;

        return $link;
    }
}
