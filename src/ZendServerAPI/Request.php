<?php
namespace ZendServerAPI;

class Request 
{
	private $action = null;
	private $userAgent = 'HTTPFUL';
	private $config = null;
	
	public function __construct()
	{

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
		    $httpful = \Httpful\Request::get($this->getLink());
		}
		elseif($this->action->getMethod() === 'Post')
		{
		    $httpful = \Httpful\Request::post($this->getLink());
		}
		$response = $httpful
			->addHeader('X-Zend-Signature', $this->config->getApiKey()->getName().';'.$this->generateRequestSignature())
			->addHeader('Accept', 'application/vnd.zend.serverapi+xml;version=1.0')
			->addHeader('lookInCupboard', 'true')
			->addHeader('Date', $this->getDate())
			->addHeader("User-Agent", $this->userAgent)
			->send();
		if($response->code === 200)
			return $this->action->parseResponse($response);
		elseif($response->code === 400)
			throw new Exception\ClientSide($response);
		elseif($response->code === 401)
			throw new Exception\ClientSide($response);
		elseif($response->code === 405)
			throw new Exception\ClientSide($response);
		elseif($response->code === 406)
			throw new Exception\ClientSide($response);
		elseif($response->code === 500)
			throw new Exception\ServerSide($response);
		
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
		return hash_hmac('sha256', $data, $this->config->getApiKey()->getKey());
	}
}