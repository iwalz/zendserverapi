<?php
namespace ZendServerAPI;

class Config 
{
	protected $server = null;
	protected $readOnlyKey = null;
	protected $fullKey = null;
	
	public function __construct()
	{
		echo "Done";
	}
	
	public function setServer($server)
	{
		$this->server = $server;
	}
	
	public function setReadOnlyKey($readOnlyKey)
	{
		$this->readOnlyKey = $readOnlyKey;
	}
	
	public function setFullKey($fullKey)
	{
		$this->fullKey = $fullKey;
	}
	
	public function getServer()
	{
		return $this->server;
	}
	
	public function getReadOnlyKey()
	{
		return $this->readOnlyKey;
	}
	
	public function getFullKey()
	{
		return $this->fullKey;
	}
}