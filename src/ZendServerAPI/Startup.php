<?php

namespace ZendServerAPI;

class Startup {
	protected static $name = null;
	protected static $configPath = null;
	
	public static function getRequest($name = null)
	{
	    return self::setUpRequest($name);
	}
	
	private static function setUpRequest($name = null)
	{
	    $request = new Request();
        		
		self::configureApiKey($name, $request);
		
		return $request;
	}
	
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
	
	public static function setConfigPath($configPath)
	{
	    self::$configPath = $configPath;
	} 
	
	public static function getConfigPath()
	{
	    if(null === self::$configPath)
	        self::$configPath = __DIR__.'/../../config/servers.php';
	    
	    return self::$configPath;
	}
	
	public static function getName()
	{
	    return self::$name;
	}
}

?>