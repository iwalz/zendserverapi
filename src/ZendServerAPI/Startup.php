<?php

namespace ZendServerAPI;

class Startup {
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
	 * Generate base request based on a config section
	 * 
	 * @param string $name
	 * @return \ZendServerAPI\Request
	 */
	public static function getRequest($name = null)
	{
	    return self::setUpRequest($name);
	}
	
	/**
	 * Configure request object
	 * 
	 * @param string $name
	 * @return \ZendServerAPI\Request
	 */
	private static function setUpRequest($name = null)
	{
	    $request = new Request();
        		
		self::configureApiKey($name, $request);
		
		return $request;
	}
	
	/**
	 * Configure the api key for the request
	 * 
	 * @param string $name
	 * @param \ZendServerAPI\Request $request
	 */
	private static function configureApiKey($name, &$request)
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
        $config->setApiKey($apiKey);
        
        $request->setConfig($config);
	    
	}
	
	/**
	 * Set the config path
	 * 
	 * @param string $configPath
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
	        self::$configPath = __DIR__.'/../../config/servers.php';
	    
	    return self::$configPath;
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

?>