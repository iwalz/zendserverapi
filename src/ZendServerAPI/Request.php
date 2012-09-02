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
	
	public function setUserAgent($userAgent)
	{
	    $this->userAgent = $userAgent;
	}
	
	public function setConfig(\ZendServerAPI\Config $config)
	{
		$this->config = $config;
	}
	
	public function getAction()
	{
		return $this->action;
	}
	
	public function getUserAgent()
	{
	    return $this->userAgent;
	}
	
	public function getConfig()
	{
		return $this->config;
	}
	
	public function send($httpful = null)
	{
	    $link = 'http://' . $this->config->getHost() . ':' . $this->config->getPort() . $this->action->getLink();

		if($this->action->getMethod() === 'GET' && !$httpful)
		{
		    $httpful = \Httpful\Request::get($link);
		}
		elseif($this->action->getMethod() === 'POST')
		{
		    if(!$httpful)
		        $httpful = \Httpful\Request::post($link);
		    $content = $this->action->getContent();
		    $httpful->addHeader("Content-length", strlen($content));
		    $httpful->addHeader("Content-type", "application/x-www-form-urlencoded");
		    $httpful->body($content);
		}
		
		$httpful->addHeader('X-Zend-Signature', $this->config->getApiKey()->getName().';'.$this->generateRequestSignature($this->getDate()));
		$httpful->addHeader('Accept', 'application/vnd.zend.serverapi+xml;version=1.0');
		$httpful->addHeader('lookInCupboard', 'true');
		$httpful->addHeader('Date', $this->getDate());
		$httpful->addHeader("User-Agent", $this->userAgent);
		$response = $httpful->send();
		if($response->code === 200 || $response->code === 202)
		{
		    return $this->getAction()->parseResponse($response);
			
		}
		elseif($response->code >= 400 && $response->code <= 499)
			throw new Exception\ClientSide($response);
		elseif($response->code >= 500 && $response->code <= 599)
		    throw new Exception\ServerSide($response);
		else
		    throw new \Exception($response);
		
	}
	
	private function getDate()
	{
		$date = gmdate('D, d M Y H:i:s e');
		$date = str_replace('UTC', 'GMT', $date);
		
		return $date;
	}
	
	private function generateRequestSignature($date)
	{
		$data = $this->config->getHost() . ":".$this->config->getPort().":" .
				$this->action->getFunctionPath() . ":" .
				$this->userAgent . ":" .
				$date;
		return hash_hmac('sha256', $data, $this->config->getApiKey()->getKey());
	}
}