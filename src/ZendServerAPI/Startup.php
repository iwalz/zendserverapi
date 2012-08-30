<?php

namespace ZendServerAPI;

use Zend\Di\Di,
	Zend\Di\DefinitionList,
	Zend\Di\Config as DiConfig;

class Startup {
	protected static $di = null;
	protected static $name = null;
	protected static $configPath = null;
	
	public static function getDIC($name = null)
	{
	    if(self::$di === null)
	        self::setUpDIC($name);
	    if(self::$name !== $name)
	        self::configureApiKey($name);
	    return self::$di;
	}
	
	private static function setUpDIC($name = null)
	{
	    self::$di = new Di;
		self::$di->configure(
			new DiConfig(
				array(
					'definition' => array(
						'class' => array(
							'ZendServerAPI\Request' => array(
								'setConfig' => array('required' => true)		
							),
							'ZendServerAPI\Config' => array(
								'setApiKey' => array('required' => true)
							)		
						)
					)				
				)		
			)		
		);
		
		self::configureApiKey($name);
	}
	
	private function configureApiKey($name)
	{
	    if(null === $name)
	        self::$name = "general";
	    else
    	    self::$name = $name;
        
	    $configFile = self::getConfigPath();
	    $ini = \Zend\Config\Factory::fromFile($configFile, true);
	    
	    // Couldn't parse config
	    if(!isset($ini->{self::$name}))
	        throw new \InvalidArgumentException("Configuration part '".self::$name."' not found in: " . $configFile);
	    else
	        $config = $ini->{self::$name};
	    
	    // Check for apikeys in the configfile
	    if(isset($config->fullApiKey))
	    {
	        $state = ApiKey::FULL;
	        $key = $config->fullApiKey;
	    }
	    elseif(isset($config->readApiKey))
	    {
	        $state = ApiKey::READONLY;
	        $key = $config->readApiKey;
	    }
	    else
	        throw new \InvalidArgumentException(self::$name . " does not seem to have an apikey included");
	    
		self::$di->instanceManager()->setParameters('ZendServerAPI\ApiKey', array(
				'name' => $config->apiName, 
				'key' => $key, 
				'state' => $state
			)
		);
 		self::$di->instanceManager()->setParameters('ZendServerAPI\Config', array(
 				'host' => $config->host
 			)
 		);
	    
	}
	
	public static function setConfigPath($configPath)
	{
	    self::$configPath = $configPath;
	} 
	
	public static function getConfigPath()
	{
	    if(null === self::$configPath)
	        self::$configPath = __DIR__.'/../../config/servers.ini';
	    
	    return self::$configPath;
	}
	
	public static function getName()
	{
	    return self::$name;
	}
}

?>