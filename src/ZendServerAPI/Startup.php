<?php

namespace ZendServerAPI;

use Zend\Di\Di,
	Zend\Di\DefinitionList,
	Zend\Di\Config as DiConfig;

class Startup {
	protected static $di = null;
	
	public static function getDIC()
	{
	    if(self::$di === null)
	        self::setUpDIC();
	    
	    return self::$di;
	}
	
	private static function setUpDIC()
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
		self::$di->instanceManager()->setParameters('ZendServerAPI\ApiKey', array(
				'name' => 'api', 
				'key' => '058b82f191d934a7bfe17d12060dd3320869f132d3428fa19d35463903673eee', 
				'state' => ApiKey::FULL
			)
		);
 		self::$di->instanceManager()->setParameters('ZendServerAPI\Config', array(
 				'host' => '127.0.0.1'
 			)
 		);
	}
}

?>