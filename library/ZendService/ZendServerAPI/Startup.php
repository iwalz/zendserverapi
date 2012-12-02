<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link 		http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright 	Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license 	http://framework.zend.com/license/new-bsd New BSD License
 * @package 	Zend_Service
 */

namespace ZendService\ZendServerAPI;

/**
 * <b>Zend Server API 'bootstrap'</b>
 *
 * <pre>This class is generating a request object based on the
 * configuration.</pre>
 *
 * @license	    http://framework.zend.com/license/new-bsd New BSD License
 * @link		http://github.com/zendframework/zf2 for the canonical source repository
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @category	Zend
 * @package	    Zend_Service
 * @subpackage	ZendServerAPI
 */
class Startup
{
    /**
     * Name for the used config section
     * @var string
     */
    protected static $name = null;
    /**
     * Path to config file
     * @var string
     */
    protected static $configPath = null;
    /**
     * Disable logging
     * @var boolean
     */
    protected static $disableLogging = null;

    /**
     * Generate base request based on a config section
     *
     * @param  string                             $name
     * @return \ZendService\ZendServerAPI\Request
     */
    public static function getRequest($name = null)
    {
        return self::setUpRequest($name);
    }

    /**
     * Configure request object
     *
     * @param  string  $name
     * @return Request
     */
    private static function setUpRequest($name = null)
    {
        $request = new Request();

        self::configureApiKey($name, $request);
        self::configureProxy($request);
        self::setUpLogger($request);

        return $request;
    }

    /**
     * Configure request logger
     *
     * @param  Request $request
     * @return void
     */
    private static function setUpLogger(Request $request)
    {
        if(!is_dir(__DIR__.'/../../../logs'))
            mkdir(__DIR__.'/../../../logs');

        $validator = new ConfigValidator(self::getConfigPath());
        $conf = $validator->getSettings();

        $filter = new \Zend\Log\Filter\Priority($conf['loglevel']);
        $logger = new \Zend\Log\Logger();

        if (self::$disableLogging) {
            $logWriter = new \Zend\Log\Writer\Mock();
        } else {
            $logWriter = new \Zend\Log\Writer\Stream(__DIR__.'/../../../logs/request.log');
        }
        $logWriter->addFilter($filter);
        $logger->addWriter($logWriter);

        $request->setLogger($logger);
    }

    /**
     * Configure the api key for the request
     *
     * @param  string                             $name
     * @param  \ZendService\ZendServerAPI\Request $request
     * @return void
     */
    private static function configureApiKey($name, \ZendService\ZendServerAPI\Request $request)
    {
        if(null === $name)
            self::$name = "general";
        else
            self::$name = $name;

        $validator = new ConfigValidator(self::getConfigPath());
        $conf = $validator->getConfig(self::$name);

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

        $request->setConfig($config);

    }

    /**
     * Configure the proxy for the request
     *
     * @param  Request $request
     * @return void
     */
    private static function configureProxy(Request $request)
    {
        $validator = new ConfigValidator(self::getConfigPath());
        $conf = $validator->getSettings();
        if (isset($conf['proxyHost'])) {
            $port = isset($conf['proxyPort']) ? $conf['proxyPort'] : 8080;
            $request->getConfig()->setProxyHost($conf['proxyHost']);
            $request->getConfig()->setProxyPort($port);
        }
    }

    /**
     * Set the config path
     *
     * @param  string $configPath
     * @return void
     */
    public static function setConfigPath($configPath)
    {
        self::$configPath = $configPath;
    }

    /**
     * Get the config path
     *
     * @return string
     */
    public static function getConfigPath()
    {
        if(null === self::$configPath)
            self::$configPath = __DIR__.'/../../config/config.php';

        return self::$configPath;
    }

    /**
     * Disable logging
     *
     * @return void
     */
    public static function disableLogging()
    {
        self::$disableLogging = true;
    }

    /**
     * Enable logging
     *
     * @return void
     */
    public static function enableLogging()
    {
        self::$disableLogging = false;
    }

    /**
     * Get the name
     *
     * @return string
     */
    public static function getName()
    {
        return self::$name;
    }
}
