<?php

namespace ZendServerAPI;

abstract class Method {
	protected $method = null;
	protected $functionPath = null;
	
	const GET = 1;
	const POST = 2;
	
	public function __construct()
	{
		$this->configure();
	}
	
	public function setMethod($method)
	{
		$this->method = $method;
	}
	
	public function getMethod()
	{
		return $this->method;
	}
	
	public function setFunctionPath($functionPath)
	{
		$this->functionPath = $functionPath;
	}
	
	public function getFunctionPath()
	{
		return $this->functionPath;
	}
	
	abstract function configure();
}

?>