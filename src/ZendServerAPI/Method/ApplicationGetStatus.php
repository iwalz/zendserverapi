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
 * @package ZendServerAPI\Method
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com> 
 */

namespace ZendServerAPI\Method;

/**
 * <b>The applicationGetStatus Method</b>
 *
 * <pre>Get the list of applications currently deployed (or staged) 
 * on the server or the cluster and information about each application. 
 * If application IDs are specified, this method will return information about the
 * specified applications. If no IDs are specified, this method will return 
 * information about all applications on the server or cluster.</pre>
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendServerAPI\Method
 */
class ApplicationGetStatus extends \ZendServerAPI\Method
{
    /**
     * Application ID's to get status for
     * @var array
     */
    private $applications = array();


    /**
     * Constructor of method ApplicationGetStatus
     *
     * @param array Applications to get status for
     */
    public function __construct(array $applications = array())
    {
        $this->applications = $applications;
        parent::__construct();
    }

    /**
     * Configures all needed information for the method implementation
     *
     * @return void
     */
    public function configure ()
    {
        $this->setMethod('GET');
        $this->setFunctionPath('/ZendServerManager/Api/applicationGetStatus');
        $this->setParser(new \ZendServerAPI\Adapter\ApplicationList());
    }

    /**
     * Get link for the method
     *
     * @return string
     */
    public function getLink()
    {
        $link = $this->getFunctionPath();
        $parameterCount = count($this->applications);

        if($parameterCount > 0)
            $link .= "?";

        foreach ($this->applications as $index => $application) {
            $link .= urlencode("applications[".$index."]")."=".$application;
            if($index+1 < $parameterCount)
                $link .= "&";
        }

        return $link;
    }
}
