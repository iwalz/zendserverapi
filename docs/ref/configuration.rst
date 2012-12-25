.. highlight:: php
.. _zendservice.configuration:


*************
Configuration
*************

This chapter explains the configuration possibilities of the Zend Server API ZendService.

.. _zendservice.configuration.file:

Configuration File
==================

The API is lookig for a configfile at ``vendor/zendserverapi/zendserverapi/config/config.php`` by default.
This file is not included in the project, this will allow you to keep your project specific configuration on updates.
You can find such a skeleton at ``vendor/zendserverapi/zendserverapi/config/config.dist.php``:

.. literalinclude:: ../../config/config.dist.php


You can change the location of the configuration file by 2 different ways. Either statically, or on the BaseAPI object level.

.. code-block:: php

    <?php
    \ZendService\ZendServerAPI\PluginManager::setConfigFile(__DIR__.'/_files/config/config.php');

.. code-block:: php

    <?php
    $server = new \ZendService\ZendServerAPI\Server();
    $server->setConfig(__DIR__.'/_files/config/config.php');

.. _zendservice.configuration.server:

The Server configuration
========================

This configuration file allows you to add as many (and different) Zend Servers as you want.

The ``general`` section in the ``servers`` key is the default server. Every BaseAPI implementation (e.g. Monitor, Server, Administration, ...) receives a name with the first constructor parameter.
If none parameter is provided, the general section will be used.

.. code-block:: php

    <?php

        return array(
            "servers" => array (
                # Contains a valid default config
                "general" => array(
                    "version" => \ZendService\ZendServerAPI\Version::ZSCM56,
                    "apiName" => "admin",
                    "fullApiKey" => "bee698dde6a95de71932d65cb655c31fc4ea04c1fabaf6f0a1b852617eac32ac",
                    "readApiKey" => "",
                    "host" => "10.0.0.1",
                    "port" => "10083",
                    "protocol" => "https"
                ),
                "local" => array(
                    "version" => \ZendService\ZendServerAPI\Version::ZS56,
                    "apiName" => "admin",
                    "readApiKey" => "9dc7f8c5ac43bb2ab36120861b4aeda8f9bb6c521e124360fd5821ef279fd9c7",
                    "host" => "localhost",
                    "port" => "10081"
                )
            ),
            "settings" => array (
                'loglevel' => \Zend\Log\Logger::DEBUG
            )
        );

This configuration will give you the possibility, to connect to a remote Zend Server 5.6 Cluster Manager on port 10083 via https that way:

.. code-block:: php

    <?php
    $server = new \ZendService\ZendServerAPI\Server();
    $server->getSystemInfo();

And to do the same locally this way:

.. code-block:: php

    <?php
    $server = new \ZendService\ZendServerAPI\Server('local');
    $server->getSystemInfo();

*Note*: If you use port 10082, https will be selected automatically. If you want to use http and port 10082, you've to set it explicit in the config.
On every other port, http will be selected by default.

.. _zendservice.configuration.settings:

Configuration settings
======================

The settings allow you to set a proxy and to change the loglevel that is used for every request. I suggest to use ``\Zend\Log\Logger::DEBUG`` for development and ``\Zend\Log\Logger::INFO`` for production (for auditing purposes).
``\Zend\Log\Logger::DEBUG`` will give you the plain HTTP requests and the responses. This is causing a huge amount of data per request. ``\Zend\Log\Logger::INFO`` will simply tell you, which request was performt on which server and when.

The proxy setting looks like this:

.. code-block:: php

    <?php

    return array(
    	"servers" => array (
            # Contains a valid default config
    	    "general" => array(
                "version" => \ZendService\ZendServerAPI\Version::ZS56,
    		    "apiName" => "",
    		    "fullApiKey" => "",
    		    "readApiKey" => "",
    		    "host" => "localhost",
    		    "port" => "10081"
    	    )
        ),
        "settings" => array (
            'loglevel' => \Zend\Log\Logger::DEBUG,
            'proxyHost' => 'http://internal.proxy',
            'proxyPort' => 8010
        )
    );

*Note*: If you don't specify a proxy port, 8080 will be used by default.
