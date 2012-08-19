<?php
namespace ZendServerAPI;

class Config 
{
	protected $host = null;
	protected $port = '10081';
	protected $apiKey = null;
	
	public function __construct()
	{

	}
	
	public function setApiKey(ApiKey $apiKey)
	{
		$this->apiKey = $apiKey;
	}
	
	public function setHost($host)
	{
		$this->host = $host;
	}
	
	public function setPort($port)
	{
		$this->port = $port;
	}
	
	public function getHost()
	{
		return $this->host;
	}
	
	public function getPort()
	{
		return $this->port;
	}
	
	public function getApiKey()
	{
		return $this->apiKey;
	}
}