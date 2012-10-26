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
 * SystemInfo model implementation.
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 */
class SystemInfo
{
    /**
     * The global status information, which can be one of the following:
     * OK
     *     The system is operational.
     * notLicensed
     *     The system is not licensed.
     *     In Zend Server Cluster Manager, this
     *     means the Zend Server Cluster Manager
     *     is not licensed, but the nodes may be
     *     licensed and operating.
     * pendingRestart
     *     The system is pending a PHP restart. In Zend Server Cluster
     *     Manager this will never be set.
     * @var string
     */
    protected $status = null;
    /**
     * The Zend Server edition, which can be one of the following:
     * - ZendServer
     * - ZendServerClusterManager
     * - ZendServerCommunityEdition
     * @var string
     */
    protected $edition = null;
    /**
     * The full version of Zend Server (e.g. “5.0.4”).
     * @var string
     */
    protected $zendServerVersion = null;
    /**
     * A comma-separated list of the supported content
     * types/versions of the Zend Server Web API.
     * @var string
     */
    protected $supportedApiVersions = null;
    /**
     * The full PHP version (e.g. “5.3.3”).
     * @var string
     */
    protected $phpVersion = null;
    /**
     * A string identifying the operating system.
     * @var string
     */
    protected $operatingSystem = null;
    /**
     * A string representing the schema
     * version of the deployment feature.
     * @var string
     */
    protected $deploymentVersion = null;
    /**
     * Information about the Zend Server license.
     * If it is running in a cluster, it will
     * contain the node license information
     * @var \ZendServerAPI\DataTypes\LicenseInfo
     */
    protected $serverLincenseInfo = null;
    /**
     * Information about the Zend Server
     * Cluster Manager license.
     * @var \ZendServerAPI\DataTypes\LicenseInfo
     */
    protected $managerLicenseInfo = null;
    /**
     * A list of messages reported by this server,
     * which is empty if there are no messages to show.
     * @var \ZendServerAPI\DataTypes\MessageList
     */
    protected $messageList = null;

    /**
     * Get the global status information, which can be one of the following:
     * OK
     *     The system is operational.
     * notLicensed
     *     The system is not licensed.
     *     In Zend Server Cluster Manager, this
     *     means the Zend Server Cluster Manager
     *     is not licensed, but the nodes may be
     *     licensed and operating.
     * pendingRestart
     *     The system is pending a PHP restart. In Zend Server Cluster
     *     Manager this will never be set.
     *
     * @return string
     */
    public function getStatus ()
    {
        return $this->status;
    }

    /**
     * The Zend Server edition, which can be one of the following:
     * - ZendServer
     * - ZendServerClusterManager
     * - ZendServerCommunityEdition
     *
     * @return string
     */
    public function getEdition ()
    {
        return $this->edition;
    }

    /**
     * Get the full version of Zend Server (e.g. “5.0.4”).
     *
     * @return string
     */
    public function getZendServerVersion ()
    {
        return $this->zendServerVersion;
    }

    /**
     * Get a comma-separated list of the supported content
     * types/versions of the Zend Server Web API.
     *
     * @return string
     */
    public function getSupportedApiVersions ()
    {
        return $this->supportedApiVersions;
    }

    /**
     * Get the full PHP version (e.g. “5.3.3”).
     *
     * @return string
     */
    public function getPhpVersion ()
    {
        return $this->phpVersion;
    }

    /**
     * Get a string identifying the operating system.
     *
     * @return string
     */
    public function getOperatingSystem ()
    {
        return $this->operatingSystem;
    }

    /**
     * Get a string representing the schema
     * version of the deployment feature.
     *
     * @return string
     */
    public function getDeploymentVersion ()
    {
        return $this->deploymentVersion;
    }

    /**
     * Get the information about the Zend Server license.
     * If it is running in a cluster, it will
     * contain the node license information
     *
     * @return \ZendServerAPI\DataTypes\LicenseInfo
     */
    public function getServerLincenseInfo ()
    {
        return $this->serverLincenseInfo;
    }

    /**
     * Get the information about the Zend Server
     * Cluster Manager license.
     *
     * @return \ZendServerAPI\DataTypes\LicenseInfo
     */
    public function getManagerLicenseInfo ()
    {
        return $this->managerLicenseInfo;
    }

    /**
     * Get a list of messages reported by this server,
     * which is empty if there are no messages to show.
     *
     * @return \ZendServerAPI\DataTypes\MessageList
     */
    public function getMessageList ()
    {
        return $this->messageList;
    }

    /**
     * Set the global status information, which can be one of the following:
     * OK
     *     The system is operational.
     * notLicensed
     *     The system is not licensed.
     *     In Zend Server Cluster Manager, this
     *     means the Zend Server Cluster Manager
     *     is not licensed, but the nodes may be
     *     licensed and operating.
     * pendingRestart
     *     The system is pending a PHP restart. In Zend Server Cluster
     *     Manager this will never be set.
     *
     * @param  string $status
     * @return void
     */
    public function setStatus ($status)
    {
        $this->status = $status;
    }

    /**
     * Set the Zend Server edition, which can be one of the following:
     * - ZendServer
     * - ZendServerClusterManager
     * - ZendServerCommunityEdition
     *
     * @param  string $edition
     * @return void
     */
    public function setEdition ($edition)
    {
        $this->edition = trim($edition);
    }

    /**
     * Set the full version of Zend Server (e.g. “5.0.4”).
     *
     * @param  string $zendServerVersion
     * @return void
     */
    public function setZendServerVersion ($zendServerVersion)
    {
        $this->zendServerVersion = $zendServerVersion;
    }

    /**
     * Set a comma-separated list of the supported content
     * types/versions of the Zend Server Web API.
     *
     * @param  string $supportedApiVersions
     * @return void
     */
    public function setSupportedApiVersions ($supportedApiVersions)
    {
        $this->supportedApiVersions = $supportedApiVersions;
    }

    /**
     * Set the full PHP version (e.g. “5.3.3”).
     *
     * @param  string $phpVersion
     * @return void
     */
    public function setPhpVersion ($phpVersion)
    {
        $this->phpVersion = $phpVersion;
    }

    /**
     * Set a string identifying the operating system.
     *
     * @param  string $operatingSystem
     * @return void
     */
    public function setOperatingSystem ($operatingSystem)
    {
        $this->operatingSystem = $operatingSystem;
    }

    /**
     * Set a string representing the schema
     * version of the deployment feature.
     *
     * @param  string $deploymentVersion
     * @return void
     */
    public function setDeploymentVersion ($deploymentVersion)
    {
        $this->deploymentVersion = $deploymentVersion;
    }

    /**
     * Set the information about the Zend Server license.
     * If it is running in a cluster, it will
     * contain the node license information
     *
     * @param \ZendServerAPI\DataTypes\LicenseInfo $serverLincenseInfo
     * @return void
     */
    public function setServerLincenseInfo (\ZendServerAPI\DataTypes\LicenseInfo $serverLincenseInfo)
    {
        $this->serverLincenseInfo = $serverLincenseInfo;
    }

    /**
     * Set the information about the Zend Server
     * Cluster Manager license.
     *
     * @param  \ZendServerAPI\DataTypes\LicenseInfo $managerLicenseInfo
     * @return void
     */
    public function setManagerLicenseInfo ($managerLicenseInfo)
    {
        $this->managerLicenseInfo = $managerLicenseInfo;
    }

    /**
     * Set a list of messages reported by this server,
     * which is empty if there are no messages to show.
     *
     * @param  \ZendServerAPI\DataTypes\MessageList $messageList
     * @return void
     */
    public function setMessageList (\ZendServerAPI\DataTypes\MessageList $messageList)
    {
        $this->messageList = $messageList;
    }

}
