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

namespace ZendServerAPI\Method;

/**
 * <b>The applicationRemove Method</b>
 *
 * <pre>This method allows you to remove an existing application.
 * This process is asynchronous, meaning the initial request will start
 * the removal process and the initial response will show information about the
 * application being removed. However, the removal process will proceed after the
 * response is returned. You must continue checking the application status using the
 * applicationGetStatus method until the removal process is complete.
 * Once applicationGetStatus contains no information about the application,
 * it has been completely removed</pre>
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package ZendServerAPI\Method
 */
class ApplicationRemove extends \ZendServerAPI\Method
{
    /**
     * ApplicationId to remove
     * @var int
     */
    private $applicationId = null;

    /**
     * Constructor for ApplicationRemove method
     *
     * @param int $applicationId ApplicationId to remove
     */
    public function __construct($applicationId)
    {
        $this->applicationId = $applicationId;
        parent::__construct();
    }

    /**
     * Configures all needed information for the method implementation
     *
     * @return void
     */
    public function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/applicationRemove');
        $this->setParser(new \ZendServerAPI\Adapter\ApplicationInfo());
    }

    /**
     * Content for POST request
     *
     * @return string
     */
    public function getContent()
    {
        return ("appId=".$this->applicationId);
    }
}
