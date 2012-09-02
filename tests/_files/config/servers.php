<?php

return array(
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
		"apiName" => "apikey",
		"host" => "10.0.1.72",
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
        "fullApiKey" => "f739a0f7e43e55b2ea4dcca3ca1a3a744540836657af4e35df919578e1c3e442",
        "apiName" => "api",
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
);
