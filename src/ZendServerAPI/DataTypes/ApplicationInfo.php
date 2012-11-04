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

namespace ZendServerAPI\DataTypes;

/**
 * ApplicationInfo model implementation.
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 */
class ApplicationInfo extends DataType
{
    /**
     * The application's id
     * @var int
     */
    protected $id = null;
    /**
     * The application's baseUrl
     * @var string
     */
    protected $baseUrl = null;
    /**
     * The application's name
     * @var string
     */
    protected $appName = null;
    /**
     * Free text for the user defined application identifier
     * @var string
     */
    protected $userAppName = null;
    /**
     * The location of the file system in which the application's
     * source code is located
     * @var string
     */
    protected $installedlocation = null;
    /**
     * The application's status, which may be one of the following codes:
     * - uploadError
     * - staging
     * - stageError
     * - activating
     * - deployed
     * - activateError
     * - deactivating
     * - deactivateError
     * - unstaging
     * - unstageError
     * - rollingBack
     * - rollbackError
     * - unknown
     * - partially deployed (available for Zend Server Cluster Manager only)
     * - notExists
     * @var string
     */
    protected $status = null;
    /**
     * Details of the application's status and version per server
     * @var array \ZendServerAPI\DataTypes\ApplicationServer
     */
    protected $servers = array();
    /**
     * Some messages
     * @var \ZendServerAPI\DataTypes\MessageList
     */
    protected $messageList = null;
    /**
     * A list of messages related to the application
     * @var array \ZendServerAPI\DataTypes\DeployedVersions
     */
    protected $deployedVersions = array();

    /**
     * Get the application's ID
     *
     * @return integer
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * Get the application's base Url
     *
     * @return string
     */
    public function getBaseUrl ()
    {
        return $this->baseUrl;
    }

    /**
     * Get the application's name
     *
     * @return string
     */
    public function getAppName ()
    {
        return $this->appName;
    }

    /**
     * Get free text
     *
     * @return string
     */
    public function getUserAppName ()
    {
        return $this->userAppName;
    }

    /**
     * Some messages
     * @return \ZendServerAPI\DataTypes\MessageList
     */
    public function getMessageList()
    {
        return $this->messageList;
    }

    /**
     * Get the application's path on the file system
     *
     * @return string
     */
    public function getInstalledlocation ()
    {
        return $this->installedlocation;
    }

    /**
     * Get the application's status. Might be one of the following:
     * - uploadError
     * - staging
     * - stageError
     * - activating
     * - deployed
     * - activateError
     * - deactivating
     * - deactivateError
     * - unstaging
     * - unstageError
     * - rollingBack
     * - rollbackError
     * - unknown
     * - partially deployed (available for Zend Server Cluster Manager only)
     * - notExists
     *
     * @return string
     */
    public function getStatus ()
    {
        return $this->status;
    }

    /**
     * Get the list of servers with the application's status and version
     *
     * @return array \ZendServerAPI\DataTypes\ApplicationServer
     */
    public function getServers ()
    {
        return $this->servers;
    }

    /**
     * Get the list of messages, related to the application
     *
     * @return array
     */
    public function getDeployedVersions ()
    {
        return $this->deployedVersions;
    }

    /**
     * Set the application's ID
     *
     * @param  integer $id
     * @return void
     */
    public function setId ($id)
    {
        $this->id = (int) $id;
    }

    /**
     * Set the application's base Url
     *
     * @param  string $baseUrl
     * @return void
     */
    public function setBaseUrl ($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * Set the application's name
     *
     * @param  string $appName
     * @return void
     */
    public function setAppName ($appName)
    {
        $this->appName = $appName;
    }

    /**
     * Set free text
     *
     * @param  string $userAppName
     * @return void
     */
    public function setUserAppName ($userAppName)
    {
        $this->userAppName = $userAppName;
    }

    /**
     * Set some messages
     * @param  \ZendServerAPI\DataTypes\MessageList $messageList
     * @return void
     */
    public function setMessageList(\ZendServerAPI\DataTypes\MessageList $messageList)
    {
        $this->messageList = $messageList;
    }

    /**
     * Set path of the application
     *
     * @param  string $installedlocation
     * @return void
     */
    public function setInstalledlocation ($installedlocation)
    {
        $this->installedlocation = $installedlocation;
    }

    /**
     * Set the application's status, has to be one of this:
     * - uploadError
     * - staging
     * - stageError
     * - activating
     * - deployed
     * - activateError
     * - deactivating
     * - deactivateError
     * - unstaging
     * - unstageError
     * - rollingBack
     * - rollbackError
     * - unknown
     * - partially deployed (available for Zend Server Cluster Manager only)
     * - notExists
     *
     * @param  string $status
     * @return void
     */
    public function setStatus ($status)
    {
        $this->status = $status;
    }

    /**
     * Set the application's servers
     *
     * @param array \ZendServerAPI\DataTypes\ApplicationServer
     * @return void
     */
    public function setServers ($servers)
    {
        $this->servers = $servers;
    }

    /**
     * Set a list of messages, related to the application
     *
     * @param  \ZendServerAPI\DataTypes\DeployedVersions $deployedVersions
     * @return void
     */
    public function addDeployedVersions (\ZendServerAPI\DataTypes\DeployedVersions $deployedVersions)
    {
        $this->deployedVersions[] = $deployedVersions;
    }

    /**
     * Set a list of messages, related to the application
     *
     * @param  array $deployedVersions
     * @return void
     */
    public function setDeployedVersions (array $deployedVersions)
    {
        $this->deployedVersions = $deployedVersions;
    }

    /**
     * Add a server
     *
     * @param  \ZendServerAPI\DataTypes\ApplicationServer $server
     * @return void
     */
    public function addServer(\ZendServerAPI\DataTypes\ApplicationServer $server)
    {
        $this->servers[] = $server;
    }
}
