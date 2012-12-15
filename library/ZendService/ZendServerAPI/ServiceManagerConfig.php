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

use Zend\ServiceManager\ServiceManagerAwareInterface;

use Zend\Log\LoggerAwareInterface;
use Zend\ServiceManager\ConfigInterface;
use Zend\ServiceManager\ServiceManager;

/**
 * The Servicemanager configuration.
 * This class should be the only one, manipulating instances within the SM inside the API.
 * Changes from outside are proxied to this class. 
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class ServiceManagerConfig implements ConfigInterface
{
    /**
     * The log file
     * @var string
     */
    private $logFile = null;
    /**
     * The logger
     * @var \Zend\Log\LoggerInterface
     */
    private $logger = null;
    /**
     * The used config file
     * @var string
     */
    public static $configFile = null;
    /**
     * Disable/enable the logging
     * @var bool
     */
    private $disableLogging = null;
    /**
     * The name of the used Zend Server config
     * @var string
     */
    private $name = null;
    /**
     * The service manager
     * @var \Zend\ServiceManager\ServiceManager
     */
    private $sm = null;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->logFile = __DIR__.'/../../../logs/request.log';
        $this->disableLogging = false;
        
        if(self::$configFile === null)
            self::$configFile = __DIR__.'/../../../config/config.php';
        
        $this->name = "general";
    }
    
    /**
     * (non-PHPdoc)
     * @see \Zend\ServiceManager\ConfigInterface::configureServiceManager()
     */
    public function configureServiceManager (ServiceManager $serviceManager)
    {
        $this->sm = $serviceManager;
        $serviceManager->setAllowOverride(true);
        
        $this->configureInitializers($serviceManager);
        $this->configureInvokables($serviceManager);
        $this->configureFactories($serviceManager);
        
        $this->setConfigFile(self::$configFile);
        $this->enableLogging();
    }    
    
    /**
     * Configures SM factories
     * 
     * @param ServiceManager $serviceManager
     */
    private function configureFactories(ServiceManager $serviceManager)
    {
        $logFile = $this->getLogFile();
        
        $serviceManager->setFactory("default_log", function($serviceManager) use($logFile) {
            $settings = $serviceManager->get('settings');
            $filter = new \Zend\Log\Filter\Priority($settings['loglevel']);
            $logger = new \Zend\Log\Logger();
            
            if(!is_dir(dirname($logFile)))
                mkdir(dirname($logFile));
            $logWriter = new \Zend\Log\Writer\Stream($logFile);
            
            $logWriter->addFilter($filter);
            $logger->addWriter($logWriter);
            
            return $logger;
        });
        
        $serviceManager->setFactory("mock_log", function($serviceManager) {
            $logger = new \Zend\Log\Logger();
            $logWriter = new \Zend\Log\Writer\Mock();
            $logger->addWriter($logWriter);
            
            return $logger;
        });
        
        $serviceManager->setFactory("http_client", function($serviceManager) {
            $config = $serviceManager->get("config");
            $client = new \Zend\Http\Client();
            if ( $config->getProxyHost() !== null ) {
                $proxyAdapter = new \Zend\Http\Client\Adapter\Proxy();
                $options = array(
                        'proxy_host' => $config->getProxyHost(),
                        'proxy_port' => $config->getProxyPort()
                );
                $proxyAdapter->setOptions($options);
                $client->setAdapter($proxyAdapter);
            }
            
            return $client;
        });
    }
    
    /**
     * Configure invokables for the SM
     *
     * @param \Zend\ServiceManager\ServiceManager
     * @return void
     */
    private function configureInvokables(ServiceManager $serviceManager)
    {
        $serviceManager->setInvokableClass("request", '\ZendService\ZendServerAPI\Request');
    }
    
    /**
     * Configure initializers for the SM 
     * 
     * @return void
     */
    private function configureInitializers($serviceManager)
    {
        $serviceManager->addInitializer(function($instance, $serviceManager) {
            if($instance instanceof LoggerAwareInterface) {
                $instance->setLogger($serviceManager->get("logger"));
            }
        });

        $serviceManager->addInitializer(function($instance, $serviceManager) {
            if($instance instanceof ConfigAwareInterface) {
                $instance->setConfig($serviceManager->get("config"));
            }
        });
        
        $serviceManager->addInitializer(function($instance, $serviceManager) {
            if($instance instanceof ServiceManagerAwareInterface) {
                $instance->setServiceManager($serviceManager);
            }
        });
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
     * Set the log file
     * 
     * @param string $logFile
     * @return void
     */
    public function setLogFile($logFile)
    {
        $this->logFile = $logFile;
    }
    
    /**
     * Set a costum logger
     * 
     * @param \Zend\Log\LoggerInterface $logger
     * @return void
     */
    public function setLogger(\Zend\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
        
        if($this->sm->get('logger') !== $this->sm->get('mock_log')) {
            $this->sm->setService("logger", $this->logger);
        }
    }
    
    /**
     * Get the log file
     * 
     * @return string
     */
    public function getLogFile()
    {
        return $this->logFile;
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
     * Set a real logger, the default or a costum
     * 
     * @return void
     */
    public function enableLogging()
    {
        if($this->logger === null)
            $this->sm->setService('logger', $this->sm->get('default_log'));
        else
            $this->sm->setService('logger', $this->logger);
    }
    
    /**
     * Set the mock writer to the SM
     * 
     * @return void
     */
    public function disableLogging()
    {
        $this->sm->setService('logger', $this->sm->get('mock_log'));        
    }
    
    /**
     * Set a new config file
     * 
     * @param string $configFile
     * @return void|\ZendService\ZendServerAPI\Config|multitype:
     */
    public function setConfigFile($configFile)
    {
        $name = $this->getName();
        $validator = new ConfigValidator($configFile);

        // Initialize the config
        $this->sm->setFactory("config", function($serviceManager) use($name, $validator) {
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
        
            return $config;
        });

        // Initialize the settings
        $this->sm->setFactory("settings", function($serviceManager) use($validator) {
            $config = $serviceManager->get("config");
            
            $settings = $validator->getSettings();
            if (isset($settings['proxyHost'])) {
                $port = isset($settings['proxyPort']) ? $settings['proxyPort'] : 8080;
                $config->setProxyHost($settings['proxyHost']);
                $config->setProxyPort($port);
            }
            return $settings;
        });
        
        // There is no config object, if the default file is not configured
        // Set it afterwards or get an error on send()
        try {
            $config = $this->sm->get("config");
        } catch (\Zend\ServiceManager\Exception\ServiceNotCreatedException $e) {
            return;
        }
        
        $configNumber = str_replace(".", "", $config->getApiVersion());
        
        // Add Web API 1.0 Factory if available
        if($configNumber >= 10) {
            $this->sm->addAbstractFactory(
                    '\ZendService\ZendServerAPI\Factories\ApiVersion10CommandFactory', true
            );
        }

        // Add Web API 1.1 Factory if available
        if($configNumber >= 11) {
            $this->sm->addAbstractFactory(
                    '\ZendService\ZendServerAPI\Factories\ApiVersion11CommandFactory', true
            );
        }
        
        // Add Web API 1.2 Factory if available
        if($configNumber >= 12) {
            $this->sm->addAbstractFactory(
                    '\ZendService\ZendServerAPI\Factories\ApiVersion12CommandFactory', true
            );
        }
        
    }
    
    /**
     * Inject a costum request object
     * 
     * @param Request $request
     * @return void
     */
    public function setRequest(Request $request)
    {
        $this->sm->setService("request", $request);
    }
}

