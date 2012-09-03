<?php
namespace ZendServerAPI;

class Request 
{
    /**
     * Method class for the request
     * @var \ZendServerAPI\Method
     */
	private $action = null;
	/**
	 * Useragent for the request
	 * @var string
	 */
	private $userAgent = 'HTTPFUL';
	/**
	 * Config for the connection
	 * @var \ZendServerAPI\Config
	 */
	private $config = null;
	
	/**
	 * Constructor for the request class
	 */
	public function __construct()
	{

	}
	
	/**
	 * Set method implementation object
	 * 
	 * @param \ZendServerAPI\Method $action
	 * @return \ZendServerAPI\Request
	 */
	public function setAction(\ZendServerAPI\Method $action)
	{
		$this->action = $action;
		return $this;
	}
	
	/**
	 * Set the user agent used by the request
	 * 
	 * @param string $userAgent
	 */
	public function setUserAgent($userAgent)
	{
	    $this->userAgent = $userAgent;
	}
	
	/**
	 * Get the used config object
	 * 
	 * @param \ZendServerAPI\Config $config
	 */
	public function setConfig(\ZendServerAPI\Config $config)
	{
		$this->config = $config;
	}
	
	/**
	 * Return the current action object
	 * 
	 * @return \ZendServerAPI\Method
	 */
	public function getAction()
	{
		return $this->action;
	}
	
	/**
	 * Returns the user agent 
	 * 
	 * @return string
	 */
	public function getUserAgent()
	{
	    return $this->userAgent;
	}
	
	/**
	 * Returns the currently used config
	 * 
	 * @return \ZendServerAPI\Config
	 */
	public function getConfig()
	{
		return $this->config;
	}
	
	/**
	 * This method performs the real REST call
	 * 
	 * @param \Httpful\Request $httpful
	 * @throws \ZendServerAPI\Exception\ClientSide
	 * @throws \ZendServerAPI\Exception\ServerSide
	 * @throws \Exception
	 */
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
	
	/**
	 * Get a special formatted date string, needed by the server api
	 * 
	 * @return string
	 */
	private function getDate()
	{
		$date = gmdate('D, d M Y H:i:s e');
		$date = str_replace('UTC', 'GMT', $date);
		
		return $date;
	}
	
	/**
	 * Calculate the request signature used for authentification
	 * 
	 * @param string $date
	 * @return string
	 */
	private function generateRequestSignature($date)
	{
		$data = $this->config->getHost() . ":".$this->config->getPort().":" .
				$this->action->getFunctionPath() . ":" .
				$this->userAgent . ":" .
				$date;
		return hash_hmac('sha256', $data, $this->config->getApiKey()->getKey());
	}
}