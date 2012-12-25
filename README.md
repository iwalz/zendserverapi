Zend Server API
===============

Master: [![Build Status](https://secure.travis-ci.org/iwalz/zendserverapi.png?branch=master)](http://travis-ci.org/iwalz/zendserverapi)

[PHP Doc](http://zs-apidoc.rubber-duckling.net)

[Documentation](https://zend-server-api.readthedocs.org/en/latest/)

## Installation via composer 
To install the Zend Server API, your <code>composer.json</code> file should look like this:
<pre>
{
  "repositories": [
  	{
			"type": "composer",
			"url": "http://packages.zendframework.com/"
		}
	],
  "require": {
  	"zendserverapi/zendserverapi": "dev-master"
  },
  "minimum-stability": "dev"
}
</pre>

Run <code>composer install</code> from your project root and you should be ready to go.

<b>Please note:</b>You don't really need the repositories section in your <code>composer.json</code> - the side effect will be, that you've the whole zf2 framework installed via composer. The library still works as expected, but there will be an overhead during installation.

## Configure your servers
You can find the configuration file, starting from your project root, at <code>vendor/zendserverapi/zendserverapi/config/config.php</code>.

A valid configfile may look like this:
```php
<?php

return array(
  "servers" => array (
    # Contains a valid default config
    "general" => array(
      "version" => \ZendService\ZendServerAPI\Version::ZS56,
      "apiName" => "api",
      "fullApiKey" => "bee698dde6a95de71932d65cb655c31fc4ea04c1fabaf6f0a1b852617eac32ab",
      "readApiKey" => "",
      "host" => "10.0.1.100",
      "port" => "10081"
    )
  ),
  "settings" => array (
    'loglevel' => \Zend\Log\Logger::DEBUG,
    'proxyHost' => 'proxy',
    'proxyPort' => 8080
  )
);
```

<b>Please note:</b> you can manage multiple servers within this configfile:
```php
<?php

return array(
  "servers" => array (
    # Contains a valid default config
    "general" => array(
      "version" => \ZendService\ZendServerAPI\Version::ZS56,
      "apiName" => "api",
      "fullApiKey" => "bee698dde6a95de71932d65cb655c31fc4ea04c1fabaf6f0a1b852617eac32ab",
      "readApiKey" => "",
      "host" => "10.0.1.100",
      "port" => "10081"
    ),
    "production" => array(
      "version" => \ZendService\ZendServerAPI\Version::ZSCM56,
      "apiName" => "admin",
      "fullApiKey" => "f49c7cd904b631ed1de43727a7c9ccca7324688482b19140a778d9b5020ca369",
      "readApiKey" => "",
      "host" => "10.20.30.1",
      "port" => "10081"
    ),
    "stage" => array(
      "version" => \ZendService\ZendServerAPI\Version::ZSCM56,
      "apiName" => "stageenvironment",
      "fullApiKey" => "71ce992da55734b0ad408264e721ca8cabfef4dba158ebeca3653eb290a49c00",
      "readApiKey" => "",
      "host" => "10.30.10.100",
      "port" => "10081"
    )
  ),
  "settings" => array (
    'loglevel' => \Zend\Log\Logger::DEBUG,
    'proxyHost' => 'proxy',
    'proxyPort' => 8080
  )
);
```
The name of the server is an (optional) parameter for every object that is used to perform actions on (Deployment, Monitor, Configuration,...). If you keep it empty, the "general" section is used as a default server.

