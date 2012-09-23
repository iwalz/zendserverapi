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
    		"fullApiKey" => "058b82f191d934a7bfe17d12060dd3320869f132d3428fa19d35463903673eee",
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
    		"fullApiKey" => "058b82f191d934a7bfe17d12060dd3320869f132d3428fa19d35463903673eee",
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
        "documentation" => array(
            "version" => \ZendServerAPI\Version::ZSCM56,
            "fullApiKey" => "9dc7f8c5ac43bb2ab36120861b4aeda8f9bb6c521e124360fd5821ef279fd9c7",
            "apiName" => "angel.eyes",
            "host" => "zscm.local",
            "port" => "10081"
        )
    )
);
