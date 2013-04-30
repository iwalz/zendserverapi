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
 * <b>The applicationUpdate Method</b>
 *
 * <pre>This method allows you to update an existing application.
 * The package you provide must contain the same application. Additionally,
 * any new parameters or new values for existing parameters must be provided.
 * This process is asynchronous, meaning the initial request will wait until
 * the package is uploaded and verified, and the initial response will show
 * information about the new version being deployed. However, the staging and
 * activation process will proceed after the response is returned. You must
 * continue checking the application status using the applicationGetStatus
 * method until the deployment process is complete.</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class ApplicationUpdate extends Method
{
    /**
     * The application's ID to update
     * @var int
     */
    protected $appId = null;
    /**
     * The application package file
     * @var string
     */
    protected $appPackage = null;
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
     * Set arguments for 'ApplicationUpdate'
     *
     * @param int    $appId
     * @param string $appPackage
     * @param bool   $ignoreFailure
     * @param array  $userParams
     */
    public function setArgs ($appId, $appPackage,
            $ignoreFailure = false, array $userParams = array())
    {
        $this->appId = $appId;
        $this->appPackage = $appPackage;
        $this->ignoreFailures = $ignoreFailure;
        $this->userParams = $userParams;

        $this->configure();

        return $this;
    }

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
        $this->setFunctionPath('/Api/applicationUpdate');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\ApplicationInfo());
    }

    /**
     * Get the content for the post request
     *
     * @return string
     */
    public function getContent()
    {
        return null;
    }

    /**
     * Get post parameter payload
     *
     * @return array
     */
    public function getContentValues()
    {
        $contentArray = array(
            'appId' => $this->appId,
            'userParams' => $this->getUserParams(),
            'ignoreFailures' => ($this->ignoreFailures === true ? 'TRUE' : 'FALSE')
        );

        return $contentArray;
    }

    /**
     * Returns the default content type
     *
     * @return string
     */
    public function getContentType()
    {
        return 'multipart/form-data';
    }

    /**
     * Get the files to post
     *
     * @return array
     */
    public function getPostFiles()
    {
        return array('appPackage' => array('fileName' => $this->appPackage, 'contentType' => 'application/vnd.zend.applicationpackage'));
    }

    /**
     * Get the application's package name
     *
     * @return $appPackage
     */
    public function getAppPackage ()
    {
        return $this->appPackage;
    }

    /**
     * Get the application ID
     *
     * @return int
     */
    public function getApplicationId()
    {
        return $this->appId;
    }

    /**
     * Ignore failures
     *
     * @return $ignoreFailures
     */
    public function getIgnoreFailures ()
    {
        return $this->ignoreFailures;
    }

    /**
     * Get the user params
     *
     * @return $userParams
     */
    public function getUserParams ()
    {
        return $this->userParams;
    }

    /**
     * Set the application package
     *
     * @param string $appPackage
     */
    public function setAppPackage ($appPackage)
    {
        $this->appPackage = $appPackage;
    }

    /**
     * Set the application ID to update
     *
     * @param int $appId
     */
    public function setApplicationId($appId)
    {
        $this->appId = $appId;
    }

    /**
     * Ignore failures
     *
     * @param boolean $ignoreFailures
     */
    public function setIgnoreFailures ($ignoreFailures)
    {
        $this->ignoreFailures = $ignoreFailures;
    }

    /**
     * Set the user params for the application
     *
     * @param array $userParams
     */
    public function setUserParams ($userParams)
    {
        $this->userParams = $userParams;
    }
}
