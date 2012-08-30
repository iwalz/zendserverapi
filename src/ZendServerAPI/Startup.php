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
        
	    $validator = new ConfigValidator(self::getConfigPath());
	    $config = $validator->getConfig(self::$name);
	    
		self::$di->instanceManager()->setParameters('ZendServerAPI\ApiKey', array(
				'name' => $config['apiName'], 
				'key' => $config['key'], 
				'state' => $config['state']
			)
		);
 		self::$di->instanceManager()->setParameters('ZendServerAPI\Config', array(
 				'host' => $config['host']
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