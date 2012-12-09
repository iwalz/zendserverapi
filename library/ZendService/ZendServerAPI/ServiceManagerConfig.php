<?php
namespace ZendService\ZendServerAPI;

use Zend\Log\LoggerAwareInterface;

use Zend\ServiceManager\ConfigInterface,
    Zend\ServiceManager\ServiceManager;

class ServiceManagerConfig implements ConfigInterface
{
    private $logFile = null;
    public static $configFile = null;
    private $disableLogging = null;
    private $name = null;
    /**
     * 
     * @var \Zend\ServiceManager\ServiceManager
     */
    private $sm = null;
    
    public function __construct()
    {
        $this->logFile = __DIR__.'/../../../logs/request.log';
        $this->disableLogging = false;
        
        if(self::$configFile === null)
            self::$configFile = __DIR__.'/../../../config/config.php';
        
        if($this->name == null)
            $this->name = "general";
        
    }
    
    public function configureServiceManager (ServiceManager $serviceManager)
    {
        $this->sm = $serviceManager;
        $logFile = $this->logFile;
        $configFile = self::$configFile;
        $disableLogging = $this->disableLogging;
        $name = $this->getName();

        $serviceManager->setAllowOverride(true);
        
        
        $serviceManager->addInitializer(function($instance, $serviceManager) {
            if($instance instanceof ConfigAwareInterface) {
                $instance->setConfig($serviceManager->get("config"));
            }
        });
        
        $serviceManager->addInitializer(function($instance, $serviceManager) {
            if($instance instanceof LoggerAwareInterface) {
                $instance->setLogger($serviceManager->get("logger"));
            }
        });
        
        $config = $this;
        $serviceManager->setFactory("request", function() use($serviceManager, $config) {
            $request = new Request();
            return $request;
        });
        
        $this->setConfigFile($configFile);
        
        $this->enableLogging();
    }    
    
    public function getConfigFile()
    {
        return self::$configFile;
    }
    
    public function setLogFile($logFile)
    {
        $this->logFile = $logFile;
    }
    
    public function getLogFile()
    {
        return $this->logFile;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function enableLogging()
    {
        $serviceManager = $this->sm;
        $logFile = $this->getLogFile();
        $serviceManager->setFactory('logger', function() use($logFile, $serviceManager) {
        
            $config = $serviceManager->get('config');
            /**
             * @var \ZendService\ZendServerAPI\Config $config
            */
            $settings = $serviceManager->get('settings');
            $filter = new \Zend\Log\Filter\Priority($settings['loglevel']);
            $logger = new \Zend\Log\Logger();
        
            if(!is_dir(__DIR__.'/../../../logs'))
                mkdir(__DIR__.'/../../../logs');
            $logWriter = new \Zend\Log\Writer\Stream($logFile);

            $logWriter->addFilter($filter);
            $logger->addWriter($logWriter);
        
            return $logger;
        });
    }
    
    public function disableLogging()
    {
        $serviceManager = $this->sm;
        $serviceManager->setFactory('logger', function() use($serviceManager) {
        
            $logger = new \Zend\Log\Logger();
            $logWriter = new \Zend\Log\Writer\Mock();
            $logger->addWriter($logWriter);
        
            return $logger;
        });
        
    }
    
    public function setConfigFile($configFile)
    {
        $name = $this->getName();
        $validator = new ConfigValidator($configFile);
        $serviceManager = $this->sm;
        $this->sm->setFactory("config", function() use($name, $validator) {
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
        
        $settings = $validator->getSettings();
        $this->sm->setFactory("settings", function() use($validator, $serviceManager) {
            $config = $serviceManager->get("config");
            
            $settings = $validator->getSettings();
            if (isset($settings['proxyHost'])) {
                $port = isset($settings['proxyPort']) ? $settings['proxyPort'] : 8080;
                $config->setProxyHost($settings['proxyHost']);
                $config->setProxyPort($port);
            }
            return $settings;
        });
        
        try {
            $config = $this->sm->get("config");
        } catch (\Zend\ServiceManager\Exception\ServiceNotCreatedException $e) {
            return;
        }
        $configNumber = str_replace(".", "", $config->getApiVersion());
        
        if($configNumber >= 10) {
            $this->sm->addAbstractFactory(
                    '\ZendService\ZendServerAPI\Factories\ApiVersion10CommandFactory', true
            );
        }
        
        if($configNumber >= 11) {
            $this->sm->addAbstractFactory(
                    '\ZendService\ZendServerAPI\Factories\ApiVersion11CommandFactory', true
            );
        }
        
        if($configNumber >= 12) {
            $this->sm->addAbstractFactory(
                    '\ZendService\ZendServerAPI\Factories\ApiVersion12CommandFactory', true
            );
        }
        
    }
    
    public function setRequest(Request $request)
    {
        $this->sm->setFactory("request", function() use($request) {
            return $request;
        });
    }
}

