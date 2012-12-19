<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright      Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @package        Zend_Service
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
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
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
     * Set arguments for 'ApplicationDeploy'
     *
     * @param string  $appPackage
     * @param string  $baseUrl
     * @param boolean $createVhost
     * @param boolean $defaultServer
     * @param string  $userAppName
     * @param boolean $ignoreFailure
     * @param array   $userParams
     */
    public function setArgs($appPackage, $baseUrl,
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
        
        $this->configure();
        
        return $this;
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
        return null;
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
