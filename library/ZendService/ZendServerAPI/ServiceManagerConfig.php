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

use Zend\Log\LoggerAwareInterface;
use Zend\ServiceManager\ConfigInterface;
use Zend\ServiceManager\ServiceManager;
use ZendService\ZendServerAPI\Hydrator\HydratorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

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
     * Disable/enable the logging
     * @var bool
     */
    private static $disableLogging = null;
    /**
     * The service manager
     * @var \ZendService\ZendServerAPI\PluginManager
     */
    private $pluginManager = null;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->logFile = __DIR__.'/../../../logs/request.log';
        if(self::$disableLogging === null)
            self::$disableLogging = false;
    }

    /**
     * Configure the service manager
     *
     * @see \Zend\ServiceManager\ConfigInterface::configureServiceManager()
     * @param \Zend\ServiceManager\ServiceManager
     */
    public function configureServiceManager (ServiceManager $serviceManager)
    {
        $this->pluginManager = $serviceManager;
        $serviceManager->setAllowOverride(true);

        $this->configureInitializers($serviceManager);
        $this->configureInvokables($serviceManager);
        $this->configureFactories($serviceManager);

        if(self::$disableLogging) {
            $this->disableLogging();
        } else {
            $this->enableLogging();
        }
    }

    /**
     * Configures SM factories
     *
     * @param \Zend\ServiceManager\ServiceManager $serviceManager
     */
    private function configureFactories(ServiceManager $serviceManager)
    {
        $logFile = $this->getLogFile();

        $serviceManager->setFactory("default_log", function($serviceManager) use ($logFile) {
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

        $serviceManager->setFactory("request", function($serviceManager) {
            $request = new Request();
            $request->setConfig($serviceManager->get("config"));

            return $request;
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
                        'proxy_port' => $config->getProxyPort(),
                        'timeout' => $config->getTimeout()
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
     * @param  \Zend\ServiceManager\ServiceManager $serviceManager
     * @return void
     */
    private function configureInvokables(ServiceManager $serviceManager)
    {
        // register adapters
        $serviceManager->setInvokableClass('applicationinfo_adapter', 'ZendService\ZendServerAPI\Adapter\ApplicationInfo');
        $serviceManager->setInvokableClass('applicationlist_adapter', 'ZendService\ZendServerAPI\Adapter\ApplicationList');
        $serviceManager->setInvokableClass('codetrace_adapter', 'ZendService\ZendServerAPI\Adapter\Codetrace');
        $serviceManager->setInvokableClass('codetracingdownloadtracefile_adapter', 'ZendService\ZendServerAPI\Adapter\CodetracingDownloadTraceFile');
        $serviceManager->setInvokableClass('codetracinglist_adapter', 'ZendService\ZendServerAPI\Adapter\CodetracingList');
        $serviceManager->setInvokableClass('codetracingstatus_adapter', 'ZendService\ZendServerAPI\Adapter\CodetracingStatus');
        $serviceManager->setInvokableClass('configurationexport_adapter', 'ZendService\ZendServerAPI\Adapter\ConfigurationExport');
        $serviceManager->setInvokableClass('debugrequest_adapter', 'ZendService\ZendServerAPI\Adapter\DebugRequest');
        $serviceManager->setInvokableClass('dumpparser_adapter', 'ZendService\ZendServerAPI\Adapter\DumpParser');
        $serviceManager->setInvokableClass('eventsgroupdetails_adapter', 'ZendService\ZendServerAPI\Adapter\EventsGroupDetails');
        $serviceManager->setInvokableClass('issue_adapter', 'ZendService\ZendServerAPI\Adapter\Issue');
        $serviceManager->setInvokableClass('issuedetails_adapter', 'ZendService\ZendServerAPI\Adapter\IssueDetails');
        $serviceManager->setInvokableClass('issuelist_adapter', 'ZendService\ZendServerAPI\Adapter\IssueList');
        $serviceManager->setInvokableClass('messagelist_adapter', 'ZendService\ZendServerAPI\Adapter\MessageList');
        $serviceManager->setInvokableClass('monitorexportissuebyeventsgroup_adapter', 'ZendService\ZendServerAPI\Adapter\MonitorExportIssueByEventsGroup');
        $serviceManager->setInvokableClass('requestsummary_adapter', 'ZendService\ZendServerAPI\Adapter\RequestSummary');
        $serviceManager->setInvokableClass('serverinfo_adapter', 'ZendService\ZendServerAPI\Adapter\ServerInfo');
        $serviceManager->setInvokableClass('serverslist_adapter', 'ZendService\ZendServerAPI\Adapter\ServersList');
        $serviceManager->setInvokableClass('systeminfo_adapter', 'ZendService\ZendServerAPI\Adapter\SystemInfo');

        // register datatypes
        $serviceManager->setInvokableClass('applicationinfo_datatype', 'ZendService\ZendServerAPI\DataTypes\ApplicationInfo');
        $serviceManager->setInvokableClass('applicationlist_datatype', 'ZendService\ZendServerAPI\DataTypes\ApplicationList');
        $serviceManager->setInvokableClass('applicationserver_datatype', 'ZendService\ZendServerAPI\DataTypes\ApplicationServer');
        $serviceManager->setInvokableClass('codetrace_datatype', 'ZendService\ZendServerAPI\DataTypes\CodeTrace');
        $serviceManager->setInvokableClass('codetracinglist_datatype', 'ZendService\ZendServerAPI\DataTypes\CodetracingList');
        $serviceManager->setInvokableClass('codetracingstatus_datatype', 'ZendService\ZendServerAPI\DataTypes\CodeTracingStatus');
        $serviceManager->setInvokableClass('debugrequest_datatype', 'ZendService\ZendServerAPI\DataTypes\DebugRequest');
        $serviceManager->setInvokableClass('deployedversions_datatype', 'ZendService\ZendServerAPI\DataTypes\DeployedVersions');
        $serviceManager->setInvokableClass('event_datatype', 'ZendService\ZendServerAPI\DataTypes\Event');
        $serviceManager->setInvokableClass('eventsgroup_datatype', 'ZendService\ZendServerAPI\DataTypes\EventsGroup');
        $serviceManager->setInvokableClass('eventsgroupdetails_datatype', 'ZendService\ZendServerAPI\DataTypes\EventsGroupDetails');
        $serviceManager->setInvokableClass('eventsgroups_datatype', 'ZendService\ZendServerAPI\DataTypes\EventsGroups');
        $serviceManager->setInvokableClass('generaldetails_datatype', 'ZendService\ZendServerAPI\DataTypes\GeneralDetails');
        $serviceManager->setInvokableClass('issue_datatype', 'ZendService\ZendServerAPI\DataTypes\Issue');
        $serviceManager->setInvokableClass('issuedetails_datatype', 'ZendService\ZendServerAPI\DataTypes\IssueDetails');
        $serviceManager->setInvokableClass('issuelist_datatype', 'ZendService\ZendServerAPI\DataTypes\IssueList');
        $serviceManager->setInvokableClass('licenseinfo_datatype', 'ZendService\ZendServerAPI\DataTypes\LicenseInfo');
        $serviceManager->setInvokableClass('messagelist_datatype', 'ZendService\ZendServerAPI\DataTypes\MessageList');
        $serviceManager->setInvokableClass('requestsummary_datatype', 'ZendService\ZendServerAPI\DataTypes\RequestSummary');
        $serviceManager->setInvokableClass('routedetail_datatype', 'ZendService\ZendServerAPI\DataTypes\RouteDetail');
        $serviceManager->setInvokableClass('routedetails_datatype', 'ZendService\ZendServerAPI\DataTypes\RouteDetails');
        $serviceManager->setInvokableClass('serverinfo_datatype', 'ZendService\ZendServerAPI\DataTypes\ServerInfo');
        $serviceManager->setInvokableClass('serverslist_datatype', 'ZendService\ZendServerAPI\DataTypes\ServersList');
        $serviceManager->setInvokableClass('step_datatype', 'ZendService\ZendServerAPI\DataTypes\Step');
        $serviceManager->setInvokableClass('superglobals_datatype', 'ZendService\ZendServerAPI\DataTypes\SuperGlobals');
        $serviceManager->setInvokableClass('systeminfo_datatype', 'ZendService\ZendServerAPI\DataTypes\SystemInfo');
    }

    /**
     * Configure initializers for the SM
     *
     * @param  \Zend\ServiceManager\ServiceManager $serviceManager
     * @return void
     */
    private function configureInitializers($serviceManager)
    {
        $serviceManager->addInitializer(function($instance, $serviceManager) {
            if ($instance instanceof LoggerAwareInterface) {
                $instance->setLogger($serviceManager->get("logger"));
            }
        });

        $serviceManager->addInitializer(function($instance, $serviceManager) {
            if ($instance instanceof ServiceLocatorAwareInterface) {
                $instance->setServicelocator($serviceManager);
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
     * @param  string $logFile
     * @return void
     */
    public function setLogFile($logFile)
    {
        $this->logFile = $logFile;
    }

    /**
     * Set a costum logger
     *
     * @param  \Zend\Log\LoggerInterface $logger
     * @return void
     */
    public function setLogger(\Zend\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;

        if ($this->pluginManager->get('logger') !== $this->pluginManager->get('mock_log')) {
            $this->pluginManager->setService("logger", $this->logger);
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
     * Set a real logger, the default or a costum
     *
     * @return void
     */
    public function enableLogging()
    {
        if($this->logger === null)
            $this->pluginManager->setService('logger', $this->pluginManager->get('default_log'));
        else
            $this->pluginManager->setService('logger', $this->logger);
    }

    /**
     * Set the mock writer to the SM
     *
     * @return void
     */
    public function disableLogging()
    {
        $this->pluginManager->setService('logger', $this->pluginManager->get('mock_log'));
    }

    /**
     * Disable logging statically
     *
     * @return void
     */
    public static function disableCentralLogging()
    {
        self::$disableLogging = true;
    }

    /**
     * Enable logging statically
     *
     * @return void
     */
    public static function enableCentralLogging()
    {
        self::$disableLogging = false;
    }

    /**
     * Set the config file
     *
     * @param string $configFile
     */
    public static function setConfig($configFile)
    {
        self::$configFile = $configFile;
    }
}
