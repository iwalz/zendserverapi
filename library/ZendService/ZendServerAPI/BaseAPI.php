<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright      Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @package        Zend_Service
 */

namespace ZendService\ZendServerAPI;

use Zend\ServiceManager\ServiceManager;

/**
 * <b>Abstract class for the api sections</b>
 *
 * <pre>All by the end user provided api sections (deployment, codetracing,
 * server,...) have to extend this class.</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
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
     * The service manager
     * @var \Zend\ServiceManager\ServiceManager
     */
    protected $sm = null;
    
    /**
     * Service manager config
     * @var ServiceManagerConfig
     */
    protected $smConfig = null;

    /**
     * Base constructor for all API-method implementations
     *
     * @param string  $name    <p>Name of the config</p>
     * @param Request $request <p>Request for internal usage</p>
     */
    public function __construct($name = null, Request $request = null)
    {
        $this->smConfig = new ServiceManagerConfig();
        $this->sm = new PluginManager($name, $this->smConfig);
        
        if($name !== null) {
            $this->sm->setName($name);
            $this->name = $name;
        }
        
        if ($request !== null) {
            $this->setRequest($request);
        } 

    }

    /**
     * Get the service manager config - be careful!
     * 
     * @return \ZendService\ZendServerAPI\ServiceManagerConfig
     */
    public function getServiceManagerConfig()
    {
        return $this->smConfig;
    }
    
    /**
     * Returns the current request
     *
     * @return Request
     */
    public function getRequest()
    {
        return $this->sm->get("request");
    }

    /**
     * Set the request for the current context
     *
     * @param  Request $request
     * @return void
     */
    public function setRequest(Request $request)
    {
        $this->sm->setRequest($request);
    }

    /**
     * Set the client. Most likly for testing
     *
     * @param  \Zend\Http\Client $client
     * @return void
     */
    public function setClient(\Zend\Http\Client $client)
    {
        $this->sm->get("request")->setClient($client);
    }
    
    /**
     * Set the service manager
     * 
     * @param ServiceManager $sm
     * @return void
     */
    public function setServiceManager(ServiceManager $sm)
    {
        $this->sm = $sm;
    }
    
    /**
     * Get the service manager
     * 
     * @return \Zend\ServiceManager\ServiceManager
     */
    public function getServiceManager()
    {
        return $this->sm;
    }

    /**
     * Check if connection is possible or not
     *
     * @return bool
     */
    public function canConnect()
    {
        $previousAction = $this->sm->get("request")->getAction();
        $action = new  \ZendService\ZendServerAPI\Method\GetSystemInfo();
        $this->sm->get("request")->setAction($action);
        try {
            $response = $this->sm->get("request")->send();
        } catch ( \Exception $e) {
            if($previousAction !== null)
                $this->sm->get("request")->setAction($previousAction);

            return false;
        }

        if($previousAction !== null)
            $this->sm->get("request")->setAction($previousAction);

        return true;
    }

    /**
     * Get the first event groups identifier by an given issue id.
     * This will perform an monitorGetIssuesDetails action.
     *
     * @param  int $issueId
     * @return int
     */
    protected function getFirstEventGroupsIdByIssueId($issueId)
    {
        $this->sm->get('request')->setAction($this->sm->get('monitorGetIssuesDetails')->setArgs($issueId));
        $issuesDetail = $this->sm->get("request")->send();

        $eventsGroups = $issuesDetail->getEventsGroups();
        $eventsGroupId = $eventsGroups[0]->getEventsGroupId();

        // Reset request
//         $this->sm->get("request") = Startup::getRequest($this->name);

        return $eventsGroupId;
    }
    
    public function setConfigFile($configFile)
    {
        $this->sm->setConfigFile($configFile);
    }
    
    public function enableLogging()
    {
        $this->smConfig->enableLogging();
    }
    
    public function disableLogging()
    {
        $this->smConfig->disableLogging();
    }
}
