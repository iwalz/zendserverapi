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

use Zend\ServiceManager\AbstractPluginManager;
use Zend\Log\Logger;
use Zend\Http\Client;

/**
 * The PluginManager implementation of the Zend Server API.
 * Only this class should manipulate instances inside the manager
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class PluginManager extends AbstractPluginManager
{
    /**
     * The used config file
     * @var string
     */
    private static $configFile = null;
    /**
     * The name of the used Zend Server config
     * @var string
     */
    private $name = null;
    /**
     * The servicemanager config
     * @var \ZendService\ZendServerAPI\ServiceManagerConfig
     */
    private $config = null;
    
    /**
     * Constructor for the plugin manager
     * 
     * @param string $name
     * @param ServiceManagerConfig $config
     */
    public function __construct($name = null, ServiceManagerConfig $config = null)
    {
        if(static::$configFile === null)
            static::$configFile = __DIR__.'/../../../config/config.php';

        if($name === null)
            $name = "general";
        
        $this->name = $name;
        $this->config = $config;
        
        static::setConfig(static::$configFile);
        parent::__construct($config);
    }
    
    /**
     * Get the config file
     *
     * @return string
     */
    public static function getConfigFile()
    {
        return self::$configFile;
    }

    /**
     * Set the config file
     *
     * @return string
     */
    public static function setConfigFile($configFile)
    {
        self::$configFile = $configFile;
    }
    
    /**
     * Set the name for a config section
     *
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    
    /**
     * Get the name for the config section
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Validates the plugins, managed by this component
     * 
     * @see \Zend\ServiceManager\AbstractPluginManager::validatePlugin()
     * @param mixed the handled instances
     */
    public function validatePlugin ($plugin)
    {
        if (
            $plugin instanceof PluginInterface || 
            $plugin instanceof Logger ||
            $plugin instanceof Client ||
            is_array($plugin)
        ) {
            // we're okay
            return;
        }
        
        throw new \Zend\ServiceManager\Exception\InvalidArgumentException(sprintf(
                'Plugin of type %s is invalid; must implement %s\PluginInterface',
                (is_object($plugin) ? get_class($plugin) : gettype($plugin)),
                __NAMESPACE__
        ));
    }
    
    /**
     * Inject a costum request object
     *
     * @param Request $request
     * @return void
     */
    public function setRequest(Request $request)
    {
        $this->setService("request", $request);
    }
    
    /**
     * Set a new config file
     *
     * @param string $configFile
     * @return void
     */
    public function setConfig($configFile)
    {
        $name = $this->name;
        $validator = new ConfigValidator($configFile);
    
        // Initialize the config
        $this->setFactory("config", function($serviceManager) use($name, $validator) {
            $conf = $validator->getConfig($name);
    
            $apiKey = new ApiKey($conf['apiName'], $conf['key'], $conf['state']);
            $config = new Config();
            $config->setHost($conf['host']);
            $config->setPort($conf['port']);
            $config->setApiVersion($conf['version']);
            $config->setApiKey($apiKey);
    
            if(isset($conf['protocol']))
                $config->setProtocol($conf['protocol']);
            else
                $config->setProtocol(($config->getPort() === 10082) ? 'https' : 'http');
            
            $configNumber = str_replace(".", "", $config->getApiVersion());
            
            // Add Web API 1.0 Factory 
            $serviceManager->addAbstractFactory(
                    '\ZendService\ZendServerAPI\Factories\ApiVersion10CommandFactory', true
            );
            
            // Add Web API 1.1 Factory if available
            if($configNumber >= 11) {
                $serviceManager->addAbstractFactory(
                        '\ZendService\ZendServerAPI\Factories\ApiVersion11CommandFactory', true
                );
            }
            
            // Add Web API 1.2 Factory if available
            if($configNumber >= 12) {
                $serviceManager->addAbstractFactory(
                        '\ZendService\ZendServerAPI\Factories\ApiVersion12CommandFactory', true
                );
            }
            
    
            return $config;
        });
    
        // Initialize the settings
        $this->setFactory("settings", function($serviceManager) use($validator) {
            $config = $serviceManager->get("config");

            $settings = $validator->getSettings();
            if (isset($settings['proxyHost'])) {
                $port = isset($settings['proxyPort']) ? $settings['proxyPort'] : 8080;
                $config->setProxyHost($settings['proxyHost']);
                $config->setProxyPort($port);
            }
            return $settings;
        });
    }
    
    /**
     * Enables the logging
     *
     * @return void
     */
    public function enableLogging()
    {
        $this->config->enableLogging();
    }
    
    /**
     * Disables the logging
     *
     * @return void
     */
    public function disableLogging()
    {
        $this->config->disableLogging();
    }
    
}

