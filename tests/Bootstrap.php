<?php
if (!(@include_once __DIR__ . '/../vendor/autoload.php') && 
		!(@include_once __DIR__ . '/../../../autoload.php')
)
{
	throw new RuntimeException('vendor/autoload.php could not be found. Did you run `php composer.phar install`?');
}
define('DISABLE_REAL_INTERFACE', true);

\ZendService\ZendServerAPI\ServiceManagerConfig::disableCentralLogging();
\ZendService\ZendServerAPI\PluginManager::setConfigFile(__DIR__.'/_files/config/config.php');
