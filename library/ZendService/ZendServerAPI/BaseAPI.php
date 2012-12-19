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
class BaseAPI implements PluginInterface
{
    /**
     * The 'server' name - key of the config
     * @var string
     */
    protected $name = null;
    
    /**
     * The plugin manager
     * @var \ZendService\ZendServerAPI\PluginManager
     */
    protected $pluginManager = null;
    
    /**
     * Base constructor for all API-method implementations
     *
     * @param string  $name    <p>Name of the config</p>
     * @param Request $request <p>Request for internal usage</p>
     */
    public function __construct($name = null, Request $request = null)
    {
        $smConfig = new ServiceManagerConfig();
        $this->pluginManager = new PluginManager($name, $smConfig);
        
        if($name !== null) {
            $this->pluginManager->setName($name);
            $this->name = $name;
        }
        
        if ($request !== null) {
            $this->setRequest($request);
        } 

    }

    /**
     * Returns the current request
     *
     * @return Request
     */
    public function getRequest()
    {
        return $this->pluginManager->get("request");
    }

    /**
     * Set the request for the current context
     *
     * @param  Request $request
     * @return void
     */
    public function setRequest(Request $request)
    {
        $this->pluginManager->setRequest($request);
    }

    /**
     * Set the client. Most likly for testing
     *
     * @param  \Zend\Http\Client $client
     * @return void
     */
    public function setClient(\Zend\Http\Client $client)
    {
        $this->pluginManager->get("request")->setClient($client);
    }
    
    
    /**
     * Get the plugin manager
     * 
     * @return \Zend\ServiceManager\PluginManager
     */
    public function getPluginManager ()
    {
        return $this->pluginManager;
    }

    /**
     * Check if connection is possible or not
     *
     * @return bool
     */
    public function canConnect()
    {
        $previousAction = $this->pluginManager->get("request")->getAction();
        $action = $this->pluginManager->get("getSystemInfo");
        $this->pluginManager->get("request")->setAction($action);
        try {
            $response = $this->pluginManager->get("request")->send();
        } catch ( \Exception $e) {
            if($previousAction !== null)
                $this->pluginManager->get("request")->setAction($previousAction);

            return false;
        }

        if($previousAction !== null)
            $this->pluginManager->get("request")->setAction($previousAction);

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
        $this->pluginManager->get('request')->setAction($this->pluginManager->get('monitorGetIssuesDetails')->setArgs($issueId));
        $issuesDetail = $this->pluginManager->get("request")->send();

        $eventsGroups = $issuesDetail->getEventsGroups();
        $eventsGroupId = $eventsGroups[0]->getEventsGroupId();

        return $eventsGroupId;
    }

    /**
     * Set the config file. Proxy to the pluginmanager for initialization
     * 
     * @param string $configFile
     * @return void
     */
    public function setConfigFile($configFile)
    {
        $this->pluginManager->setConfigFile($configFile);
    }
    
    /**
     * Enables the logging
     * 
     * @return void
     */
    public function enableLogging()
    {
        $this->pluginManager->enableLogging();
    }
    
    /**
     * Disables the logging
     * 
     * @return void
     */
    public function disableLogging()
    {
        $this->pluginManager->disableLogging();
    }
}
