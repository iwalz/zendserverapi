<?php
if (!(@include_once __DIR__ . '/../vendor/autoload.php') && 
		!(@include_once __DIR__ . '/../../../autoload.php')
)
{
	throw new RuntimeException('vendor/autoload.php could not be found. Did you run `php composer.phar install`?');
}

$apiKey = new \ZendServerAPI\ApiKey();
$apiKey->setName('api');
$apiKey->setKey('058b82f191d934a7bfe17d12060dd3320869f132d3428fa19d35463903673eee');
$apiKey->setState(\ZendServerAPI\ApiKey::FULL);

$config = new \ZendServerAPI\Config;
$config->setHost('127.0.0.1');
$config->setApiKey($apiKey);
$container = new \ZendServerAPITest\Container();
$container->setConfig($config);

    