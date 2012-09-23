<?php

return array(
    "settings" => array (
        'loglevel' => \Zend\Log\Logger::DEBUG
    ),
    "servers" => array(
    	# Contains a valid default config
    	"general" => array(
    		"clusterManager" => true,
    		"apiName" => "api",
    		"fullApiKey" => "058b82f191d934a7bfe17d12060dd3320869f132d3428fa19d35463903673eee",
    		"readApiKey" => "",
    		"host" => "127.0.0.1",
    		"port" => "10081"
    	),
    	# Contains invalid key (too short)
    	"example72" => array(
    		"clusterManager" => true,
    		"fullApiKey" => "abcde",
    		"readApiKey" => "",
    		"apiName" => "api",
    		"host" => "10.0.1.72",
    		"port" => "10081"
    	),
    	# Contains no key
    	"example82" => array(
    		"clusterManager" => true,
    		"apiName" => "api",
    		"host" => "10.0.1.72",
    		"port" => "10081"
    	),
    	# Contains a valid key
    	"example62" => array(
    		"clusterManager" => true,
    		"fullApiKey" => "058b82f191d934a7bfe17d12060dd3320869f132d3428fa19d35463903673eee",
    		"apiName" => "api",
    		"host" => "localhost",
    		"port" => "10081"
    	),
    	# Invalid character
    	"example92" => array(
    		"clusterManager" => true,
    		"fullApiKey" => "058b82f1;1d934a7bfe17d12060dd3320869f132d3428fa19d35463903673ee",
    		"apiName" => "api",
    		"host" => "10.0.1.72",
    		"port" => "10081"
    	),
    	# No host specified
    	"example102" => array(
    		"clusterManager" => true,
    		"fullApiKey" => "058b82f191d934a7bfe17d12060dd3320869f132d3428fa19d35463903673eee",
    		"apiName" => "api",
    		"host" => "",
    		"port" => "10081"
    	),
        # "Production" test
        "prod" => array(
            "clusterManager" => true,
            "fullApiKey" => "ad8572190150cfb7085bcc57e6c07c7d7bff3448742a86f0d973ae8fb3848cb7",
            "apiName" => "full",
            "host" => "127.0.0.1",
            "port" => "11111"
        ),
        "documentation" => array(
            "clusterManager" => true,
            "fullApiKey" => "9dc7f8c5ac43bb2ab36120861b4aeda8f9bb6c521e124360fd5821ef279fd9c7",
            "apiName" => "angel.eyes",
            "host" => "zscm.local",
            "port" => "10081"
        )
    )
);
