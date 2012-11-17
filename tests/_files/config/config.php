<?php

return array(
    "settings" => array (
        'loglevel' => \Zend\Log\Logger::DEBUG
    ),
    "servers" => array(
    	# Contains a valid default config
    	"general" => array(
    		"version" => \ZendServerAPI\Version::ZS56,
    		"apiName" => "api",
    		"fullApiKey" => "bee698dde6a95de71932d65cb655c31fc4ea04c1fabaf6f0a1b852617eac32ac",
    		"readApiKey" => "",
    		"host" => "127.0.0.1",
    		"port" => "10081"
    	),
    	# Contains invalid key (too short)
    	"example72" => array(
    		"version" => \ZendServerAPI\Version::ZSCM56,
    		"fullApiKey" => "abcde",
    		"readApiKey" => "",
    		"apiName" => "api",
    		"host" => "10.0.1.72",
    		"port" => "10081"
    	),
    	# Contains no key
    	"example82" => array(
    		"version" => \ZendServerAPI\Version::ZSCM56,
    		"apiName" => "api",
    		"host" => "10.0.1.72",
    		"port" => "10081"
    	),
    	# Contains a valid key
    	"example62" => array(
    		"version" => \ZendServerAPI\Version::ZSCM56,
    		"fullApiKey" => "bee698dde6a95de71932d65cb655c31fc4ea04c1fabaf6f0a1b852617eac32ac",
    		"apiName" => "api",
    		"host" => "localhost",
    		"port" => "10081"
    	),
    	# Invalid character
    	"example92" => array(
    		"version" => \ZendServerAPI\Version::ZSCM56,
    		"fullApiKey" => "058b82f1;1d934a7bfe17d12060dd3320869f132d3428fa19d35463903673ee",
    		"apiName" => "api",
    		"host" => "10.0.1.72",
    		"port" => "10081"
    	),
    	# No host specified
    	"example102" => array(
    		"version" => \ZendServerAPI\Version::ZSCM56,
    		"fullApiKey" => "058b82f191d934a7bfe17d12060dd3320869f132d3428fa19d35463903673eee",
    		"apiName" => "api",
    		"host" => "",
    		"port" => "10081"
    	),
        # "Production" test
        "prod" => array(
            "version" => \ZendServerAPI\Version::ZSCM56,
            "fullApiKey" => "ad8572190150cfb7085bcc57e6c07c7d7bff3448742a86f0d973ae8fb3848cb7",
            "apiName" => "full",
            "host" => "127.0.0.1",
            "port" => "11111"
        ),
        "httpsByPort" => array(
                "version" => \ZendServerAPI\Version::ZSCM56,
                "fullApiKey" => "bee698dde6a95de71932d65cb655c31fc4ea04c1fabaf6f0a1b852617eac32ac",
                "apiName" => "api",
                "host" => "localhost",
                "port" => "10082"
        ),
        "httpsBySetting" => array(
                "version" => \ZendServerAPI\Version::ZSCM56,
                "fullApiKey" => "bee698dde6a95de71932d65cb655c31fc4ea04c1fabaf6f0a1b852617eac32ac",
                "apiName" => "api",
                "host" => "localhost",
                "protocol" => "https",
                "port" => "10081"
        ),
        "protocolError" => array(
                "version" => \ZendServerAPI\Version::ZSCM56,
                "fullApiKey" => "bee698dde6a95de71932d65cb655c31fc4ea04c1fabaf6f0a1b852617eac32ac",
                "apiName" => "api",
                "host" => "localhost",
                "protocol" => "foo",
                "port" => "10081"
        ),
        "documentation" => array(
            "version" => \ZendServerAPI\Version::ZSCM56,
            "fullApiKey" => "9dc7f8c5ac43bb2ab36120861b4aeda8f9bb6c521e124360fd5821ef279fd9c7",
            "apiName" => "angel.eyes",
            "host" => "zscm.local",
            "port" => "10081"
        ),
        # "50" test
        "ZS51" => array(
            "version" => \ZendServerAPI\Version::ZS51,
            "fullApiKey" => "ad8572190150cfb7085bcc57e6c07c7d7bff3448742a86f0d973ae8fb3848cb7",
            "apiName" => "full",
            "host" => "127.0.0.1",
            "port" => "11111"
        ),
        # "55" test
        "ZS55" => array(
            "version" => \ZendServerAPI\Version::ZS55,
            "fullApiKey" => "ad8572190150cfb7085bcc57e6c07c7d7bff3448742a86f0d973ae8fb3848cb7",
            "apiName" => "full",
            "host" => "127.0.0.1",
            "port" => "11111"
        ),
    )
);
