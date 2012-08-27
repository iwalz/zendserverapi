<?php

namespace ZendServerAPI;

abstract class Method {
	protected $method = null;
	protected $functionPath = null;
	protected $parser = null;
	
	const GET = 1;
	const POST = 2;
	
	public function __construct()
	{
		static::configure();
	}
	
	public function setMethod($method)
	{
		$this->method = $method;
	}
	
	public function getMethod()
	{
		return $this->method;
	}
	
	public function setParser(\ZendServerAPI\Mapper\Mapper $parser)
	{
	    $this->parser = $parser;
	}
	
	public function getParser()
	{
	    return $this->parser;
	}
	
	public function setFunctionPath($functionPath)
	{
		$this->functionPath = $functionPath;
	}
	
	public function getFunctionPath()
	{
		return $this->functionPath;
	}

	public function parseResponse($xml)
	{
	    return $this->getParser()->parse($xml);
	}
	
	abstract function configure();
}

?>