<?php

namespace ZendServerAPI;

use Zend\Di\Di,
	Zend\Di\DefinitionList,
	Zend\Di\Config as DiConfig;

class Startup {
	protected static $di = null;
	
	/**
	 * @return Di
	 */
	public static function startup()
	{
	    if(self::$di === null)
		    return self::setUpDiC();
        else
            return self::$di;
	}
	
	public static function getDIC()
	{
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
		/*self::$di->instanceManager()->setParameters('ZendServerAPI\ApiKey', array(
				'name' => 'api', 
				'key' => '058b82f191d934a7bfe17d12060dd3320869f132d3428fa19d35463903673eee', 
				'state' => ApiKey::FULL
			)
		);*/
 		self::$di->instanceManager()->setParameters('ZendServerAPI\Config', array(
 				'host' => '127.0.0.1'
 			)
 		);
		
		$apiKey = new \ZendServerAPI\ApiKey();
		$apiKey->setName('api');
		$apiKey->setKey('058b82f191d934a7bfe17d12060dd3320869f132d3428fa19d35463903673eee');
		$apiKey->setState(ApiKey::FULL);
		
		$config = new \ZendServerAPI\Config('127.0.0.1');
		self::$di->instanceManager()->setInjections('ZendServerAPI\Config', array('setApiKey' => array('parameters' => array('apiKey' => $apiKey))));
		
		return self::$di;
	}
}

?>