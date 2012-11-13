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

class CodetracingList extends \ZendServerAPI\Method
{
    protected $applicationIds = null;
    protected $limit = null;
    protected $offset = null;
    protected $orderBy = null;
    protected $direction = null;

    /**
     * Constructor for CodetracingList method
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
     * @access public
     * @return string
     */
    public function getAcceptHeader()
    {
        return "application/vnd.zend.serverapi+xml;version=1.2";
    }

    /**
     * @see \ZendServerAPI\Method::configure()
     */
    public function configure ()
    {
        $this->setMethod('GET');
        $this->setFunctionPath('/ZendServerManager/Api/codetracingList');
        $this->setParser(new \ZendServerAPI\Adapter\CodetracingList());
    }

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
