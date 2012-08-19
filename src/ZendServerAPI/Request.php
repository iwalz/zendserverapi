<?php
namespace ZendServerAPI;

class Request 
{
	private $apiKey = null;
	private $action = null;
	private $userAgent = 'HTTPFUL';
	private $config = null;
	
	public function __construct()
	{

	}
	
	public function setApiKey(ApiKey $apiKey)
	{
		$this->apiKey = $apiKey;
	}
	
	public function setAction($action)
	{
		$this->action = $action;
		return $this;
	}
	
	public function setConfig(\ZendServerAPI\Config $config)
	{
		$this->config = $config;
	}
	
	public function getApiKey()
	{
		return $this->apiKey;
	}
	
	public function getAction()
	{
		return $this->action;
	}
	
	public function getConfig()
	{
		return $this->config;
	}
	
	public function send()
	{
		if($this->action->getMethod() === 'GET')
		{
			$response = \Httpful\Request::get($this->getLink())
				->addHeader('X-Zend-Signature', $this->apiKey->getName().';'.$this->generateRequestSignature())
				->addHeader('Accept', 'application/vnd.zend.serverapi+xml;version=1.0')
				->addHeader('lookInCupboard', 'true')
				->addHeader('Date', $this->getDate())
				->addHeader("User-Agent", $this->userAgent)
				->send();

			return $response;
		}
		
		
	}
	
	public function getLink()
	{
		return 'http://' . $this->config->getHost() . ':' . $this->config->getPort() .
				$this->action->getFunctionPath();
	}
	
	private function getDate()
	{
		$date = gmdate('D, d M Y H:i:s e');
		$date = str_replace('UTC', 'GMT', $date);
		
		return $date;
	}
	
	private function generateRequestSignature()
	{
		$date = $this->getDate();
		
		$data = $this->config->getHost() . ":".$this->config->getPort().":" .
				$this->action->getFunctionPath() . ":" .
				$this->userAgent . ":" .
				$date;
		return hash_hmac('sha256', $data, $this->apiKey->getKey());
	}
}