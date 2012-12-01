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
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendServerAPI
 */

namespace ZendServerAPI;

/**
 * <b>Abstract class for the api sections</b>
 *
 * <pre>All by the end user provided api sections (deployment, codetracing,
 * server,...) have to extend this class.</pre>
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendServerAPI
 */
class BaseAPI
{
    /**
     * Request for the methods
     * @var Request
     */
    protected $request = null;

    /**
     * Api Factory to fetch Method's from
     * @var Factories\CommandFactory
     */
    protected $apiFactory = null;

    /**
     * The 'server' name - key of the config
     * @var string
     */
    protected $name = null;

    /**
     * Base constructor for all API-method implementations
     *
     * @param string  $name    <p>Name of the config</p>
     * @param Request $request <p>Request for internal usage</p>
     */
    public function __construct($name = null, Request $request = null)
    {
        if ($request !== null) {
            $this->request = $request;
        } else {
            $this->request = Startup::getRequest($name);
        }
        $this->name = $name;

        $webApiVersionFactory = new Factories\WebApiVersionFactory();
        $webApiVersionFactory->setConfig($this->request->getConfig());
        $this->apiFactory = $webApiVersionFactory->getCommandFactory();
    }

    /**
     * Returns the current request
     *
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Set the request for the current context
     *
     * @param  Request $request
     * @return void
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Set the client. Most likly for testing
     *
     * @param  \Guzzle\Http\Client $client
     * @return void
     */
    public function setClient(\Guzzle\Http\Client $client)
    {
        $this->request->setClient($client);
    }

    /**
     * Check if connection is possible or not
     *
     * @return bool
     */
    public function canConnect()
    {
        $previousAction = $this->request->getAction();
        $action = new \ZendServerAPI\Method\GetSystemInfo();
        $this->request->setAction($action);
        try {
            $response = $this->request->send();
        } catch ( \Guzzle\Http\Exception\CurlException $e) {
            if($previousAction !== null)
                $this->request->setAction($previousAction);

            return false;
        }

        if($previousAction !== null)
            $this->request->setAction($previousAction);

        return true;
    }
    
    /**
     * Get the first event groups identifier by an given issue id.
     * This will perform an monitorGetIssuesDetails action.
     * 
     * @param int $issueId
     * @return int
     */
    protected function getFirstEventGroupsIdByIssueId($issueId) 
    {
        $this->request->setAction($this->apiFactory->factory('monitorGetIssuesDetails', $issueId));
        $issuesDetail = $this->request->send();
        
        $eventsGroups = $issuesDetail->getEventsGroups();
        $eventsGroupId = $eventsGroups[0]->getEventsGroupId();
        
        // Reset request
        $this->request = Startup::getRequest($this->name);
        
        return $eventsGroupId;
    }
}
