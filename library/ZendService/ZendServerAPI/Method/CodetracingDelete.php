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
 * @package     ZendService\ZendServerAPI\Method
 */

namespace ZendService\ZendServerAPI\Method;

/**
 * <b>The codetracingDisable Method</b>
 *
 * <pre>Disable the code-tracing directive two directives necessary
 * for creating tracing dumps, this action does not disable the
 * code-tracing component.</pre>
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package ZendService\ZendServerAPI\Method
 */
class CodetracingDelete extends Method
{
    /**
     * Trace file ID to delete
     * @var integer
     */
    private $id = null;

    /**
     * Constructor for codetracingDelete method
     *
     * @param integer $id Trace file ID
     */
    public function __construct($id)
    {
        $this->id = $id;
        parent::__construct();
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
     * Configures all needed information for the method implementation
     *
     * @return void
     */
    public function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/codetracingDelete');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\Codetrace());
    }

    /**
     * Content for POST request
     *
     * @return string
     */
    public function getContent()
    {
        return ("traceFile=".$this->id);
    }
}
