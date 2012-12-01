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
 * The applicationDeploy Method
 *
 * Deploy a new application to the server or cluster.
 * This process is asynchronous, meaning the initial request will wait until the application is uploaded and verified,
 * and the initial response will show information about the application being deployed.
 * However, the staging and activation process will proceed after the response is returned.
 * You must continue checking the application status using the applicationGetStatus method until the deployment process is complete.
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendService\ZendServerAPI\Method
 */
class ApplicationDeploy extends Method
{
    /**
     * The application package file
     * @var string
     */
    protected $appPackage = null;
    /**
     * The baseurl
     * @var string
     */
    protected $baseUrl = null;
    /**
     * Create VHost based on the baseurl
     * @var boolean
     */
    protected $createVhost = null;
    /**
     * Deploy the application on the default server
     * @var boolean
     */
    protected $defaultServer = null;
    /**
     * The user's application name
     * @var string
     */
    protected $userAppName = null;
    /**
     * Ignore failures
     * @var boolean
     */
    protected $ignoreFailures = null;
    /**
     * Values for user params
     * @var array
     */
    protected $userParams = null;

    /**
     * Method implementation of 'ApplicationDeploy' call
     *
     * @param string  $appPackage
     * @param string  $baseUrl
     * @param boolean $createVhost
     * @param boolean $defaultServer
     * @param string  $userAppName
     * @param boolean $ignoreFailure
     * @param array   $userParams
     */
    public function __construct ($appPackage, $baseUrl,
            $createVhost = false, $defaultServer = false, $userAppName = null,
            $ignoreFailure = false, array $userParams = array())
    {
        $this->appPackage = $appPackage;
        $this->baseUrl = $baseUrl;
        $this->createVhost = $createVhost;
        $this->defaultServer = $defaultServer;
        $this->userAppName = $userAppName;
        $this->ignoreFailures = $ignoreFailure;
        $this->userParams = $userParams;

        parent::__construct();
    }

    /**
     * Configure the action. Method, Path and Adapter
     *
     * @see \ZendService\ZendServerAPI\Method::configure()
     * @return void
     */
    public function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/applicationDeploy');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\ApplicationInfo());
    }

    /**
     * Get the content for post requests
     *
     * @return string
     */
    public function getContent()
    {
        return "";
    }

    /**
     * Get an array of post field key/value pairs
     *
     * @return array
     */
    public function getContentValues()
    {
        $contentArray = array(
            'baseUrl' => $this->baseUrl,
            'userParams' => $this->getUserParams(),
            'userAppName' => $this->getUserAppName(),
            'createVhost' => ($this->createVhost === true ? 'TRUE' : 'FALSE'),
            'defaultServer' => ($this->defaultServer === true ? 'TRUE' : 'FALSE'),
            'ignoreFailures' => ($this->ignoreFailures === true ? 'TRUE' : 'FALSE')
        );

        return $contentArray;
    }

    /**
     * Get the content type for this action
     *
     * @see \ZendService\ZendServerAPI\Method::getContentType()
     * @return string
     */
    public function getContentType()
    {
        return 'multipart/form-data';
    }

    /**
     * Add post files for this action
     *
     * @see \ZendService\ZendServerAPI\Method::getPostFiles()
     * @return array
     */
    public function getPostFiles()
    {
        return
            array(
                'appPackage' => array(
                    'fileName' => $this->appPackage,
                    'contentType' => 'application/vnd.zend.applicationpackage')
            );
    }

    /**
     * Get the application's package name
     *
     * @return string
     */
    public function getAppPackage ()
    {
        return $this->appPackage;
    }

    /**
     * Get the application's baseurl
     *
     * @return string
     */
    public function getBaseUrl ()
    {
        return $this->baseUrl;
    }

    /**
     * Create VHost based on baseurl
     *
     * @return bool
     */
    public function getCreateVhost ()
    {
        return $this->createVhost;
    }

    /**
     * Deploy application on the default server
     *
     * @return string
     */
    public function getDefaultServer ()
    {
        return $this->defaultServer;
    }

    /**
     * Get the user's application name
     *
     * @return string
     */
    public function getUserAppName ()
    {
        return $this->userAppName;
    }

    /**
     * Ignore failures
     *
     * @return bool
     */
    public function getIgnoreFailures ()
    {
        return $this->ignoreFailures;
    }

    /**
     * Get the user params
     *
     * @return array
     */
    public function getUserParams ()
    {
        return $this->userParams;
    }

    /**
     * Set the application package
     *
     * @param  string $appPackage
     * @return void
     */
    public function setAppPackage ($appPackage)
    {
        $this->appPackage = $appPackage;
    }

    /**
     * Set the application's baseurl
     *
     * @param  string $baseUrl
     * @return void
     */
    public function setBaseUrl ($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * Create VHost based on the baseurl
     *
     * @param  bool $createVhost
     * @return void
     */
    public function setCreateVhost ($createVhost)
    {
        $this->createVhost = $createVhost;
    }

    /**
     * Deploy the application to the default server
     *
     * @param  boolean $defaultServer
     * @return void
     */
    public function setDefaultServer ($defaultServer)
    {
        $this->defaultServer = $defaultServer;
    }

    /**
     * Set the user's application name
     *
     * @param  string $userAppName
     * @return void
     */
    public function setUserAppName ($userAppName)
    {
        $this->userAppName = $userAppName;
    }

    /**
     * Ignore failures
     *
     * @param  bool $ignoreFailures
     * @return void
     */
    public function setIgnoreFailures ($ignoreFailures)
    {
        $this->ignoreFailures = $ignoreFailures;
    }

    /**
     * Set the user params for the application (key/value pairs)
     *
     * @param  array $userParams
     * @return void
     */
    public function setUserParams ($userParams)
    {
        $this->userParams = $userParams;
    }
}
