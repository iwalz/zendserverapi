<?php
namespace ZendServerAPI\Method;

class ApplicationDeploy extends \ZendServerAPI\Method
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
     * @param string $appPackage            
     * @param string $baseUrl            
     * @param boolean $createVhost            
     * @param boolean $defaultServer            
     * @param string $userAppName            
     * @param boolean $ignoreFailure            
     * @param array $userParams            
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
     * @see \ZendServerAPI\Method::configure()
     */
    public function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/applicationDeploy');
        $this->setParser(new \ZendServerAPI\Mapper\ApplicationInfo());
    }
    
    /**
     * @return string
     */
    public function getContent()
    {
        //($this->propagateSettings === true ? 'TRUE' : 'FALSE')
        return "";
    }
    
    public function getContentValues()
    {
        return array(
                'baseUrl' => $this->baseUrl,
                'userParams' => $this->getUserParams(),
                'createVhost' => ($this->createVhost === true ? 'TRUE' : 'FALSE'),
                'defaultServer' => ($this->defaultServer === true ? 'TRUE' : 'FALSE')
        );
    }

    /**
     * @see \ZendServerAPI\Method::getContentType()
     */
    public function getContentType()
    {
        return 'multipart/form-data';
    }
    
    /**
     * @see \ZendServerAPI\Method::getPostFiles()
     */
    public function getPostFiles()
    {
        return array('appPackage' => $this->appPackage);        
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
     * Get the application's baseurl
     * 
     * @return $baseUrl
     */
    public function getBaseUrl ()
    {
        return $this->baseUrl;
    }

    /**
     * Create VHost based on baseurl
     * 
     * @return $createVhost
     */
    public function getCreateVhost ()
    {
        return $this->createVhost;
    }

    /**
     * Deploy application on the default server
     * 
     * @return $defaultServer
     */
    public function getDefaultServer ()
    {
        return $this->defaultServer;
    }

    /**
     * Get the user's application name
     * 
     * @return $userAppName
     */
    public function getUserAppName ()
    {
        return $this->userAppName;
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
     * Set the application's baseurl
     * 
     * @param string $baseUrl            
     */
    public function setBaseUrl ($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * Create VHost based on the baseurl
     * 
     * @param boolean $createVhost            
     */
    public function setCreateVhost ($createVhost)
    {
        $this->createVhost = $createVhost;
    }

    /**
     * Deploy the application to the default server
     * 
     * @param boolean $defaultServer            
     */
    public function setDefaultServer ($defaultServer)
    {
        $this->defaultServer = $defaultServer;
    }

    /**
     * Set the user's application name
     * 
     * @param string $userAppName            
     */
    public function setUserAppName ($userAppName)
    {
        $this->userAppName = $userAppName;
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

?>