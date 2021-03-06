<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright      Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @package        Zend_Service
 */

namespace ZendService\ZendServerAPI\DataTypes;

/**
 * ApplicationInfo model implementation.
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
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
     * @var array \ZendService\ZendServerAPI\DataTypes\ApplicationServer
     */
    protected $servers = array();
    /**
     * List of messages, related to the application
     * @var \ZendService\ZendServerAPI\DataTypes\MessageList
     */
    protected $messageList = null;
    /**
     * A list of deployed versions for this application
     * @var array \ZendService\ZendServerAPI\DataTypes\DeployedVersions
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
     * Get the list of messages, related to the application
     * @return \ZendService\ZendServerAPI\DataTypes\MessageList
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
     * @return array \ZendService\ZendServerAPI\DataTypes\ApplicationServer
     */
    public function getApplicationServer ()
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
     * Set a list of messages, related to the application
     * @param  \ZendService\ZendServerAPI\DataTypes\MessageList $messageList
     * @return void
     */
    public function setMessageList(\ZendService\ZendServerAPI\DataTypes\MessageList $messageList)
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
     * @param array \ZendService\ZendServerAPI\DataTypes\ApplicationServer
     * @return void
     */
    public function setServers ($servers)
    {
        $this->servers = $servers;
    }

    /**
     * Set a list of messages, related to the application
     *
     * @param  \ZendService\ZendServerAPI\DataTypes\DeployedVersions $deployedVersions
     * @return void
     */
    public function addDeployedVersions (\ZendService\ZendServerAPI\DataTypes\DeployedVersions $deployedVersions)
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
     * @param  \ZendService\ZendServerAPI\DataTypes\ApplicationServer $server
     * @return void
     */
    public function addServer(\ZendService\ZendServerAPI\DataTypes\ApplicationServer $server)
    {
        $this->servers[] = $server;
    }
}
