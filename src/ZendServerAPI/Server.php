<?php

namespace ZendServerAPI;

class Server extends BaseAPI 
{
    /**
     * Construct of 'Server' section
     * 
     * @access public
     * @param string $name name of the server to connect to
     * @param \ZendServerAPI\Request $request Request object that should be used
     */
	public function __construct($name = null, \ZendServerAPI\Request $request = null)
	{
	    parent::__construct($name);
	    
		if($request !== null)
			$this->request = $request;
	}
	
	/**
	 * PHP function for 'getSystemInfo' API call
	 * 
	 * @access public
	 * @return \ZendServerAPI\DataTypes\SystemInfo
	 */
	public function getSystemInfo()
	{
		$this->request->setAction(new \ZendServerAPI\Method\GetSystemInfo());
		return $this->request->send();
	}
	
	/**
	 * PHP function for 'ClusterGetServerStatus' API call
	 * 
	 * @access public
	 * @param array $parameters Array of server ids
	 * @return \ZendServerAPI\DataTypes\ServersList
	 */
	public function clusterGetServerStatus(array $parameters = array())
	{
	    $this->request->setAction(new \ZendServerAPI\Method\ClusterGetServerStatus($parameters));
	    return $this->request->send();
	}
	
	/**
	 * PHP function for 'ClusterRemoveServer' API call
	 * 
	 * @access public
	 * @param int $serverId The id of the server to remove
	 * @param boolean $force Skip graceful shutdown
	 * @return \ZendServerAPI\DataTypes\ServerInfo
	 */
	public function clusterRemoveServer($serverId, $force = false)
	{
	    $this->request->setAction(new \ZendServerAPI\Method\ClusterRemoveServer($serverId, $force));
	    return $this->request->send();
	}
	
	/**
	 * PHP function for 'ClusterAddServer' API call
	 * 
	 * @access public
	 * @param string $serverName name of the server
	 * @param string $serverUrl URL to server (e.g. 127.0.0.1:10081)
	 * @param string $guiPassword password of Zend Server GUI
	 * @param boolean $propagateSettings
	 * @return \ZendServerAPI\DataTypes\ServerInfo
	 */
	public function clusterAddServer($serverName, $serverUrl, $guiPassword, $propagateSettings = false)
	{
	    $this->request->setAction(new \ZendServerAPI\Method\ClusterAddServer($serverName, $serverUrl, $guiPassword, $propagateSettings));
	    return $this->request->send();
	}
	
	/**
	 * PHP function for 'ClusterDisableServer' API call
	 *
	 * @access public
	 * @param int $serverId The id of the server to disable
	 * @return \ZendServerAPI\DataTypes\ServerInfo
	 */
	public function clusterDisableServer($serverId)
	{
	    $this->request->setAction(new \ZendServerAPI\Method\ClusterDisableServer($serverId));
	    return $this->request->send();
	}
	
	/**
	 * PHP function for 'ClusterEnableServer' API call
	 *
	 * @access public
	 * @param int $serverId The id of the server to enable
	 * @return \ZendServerAPI\DataTypes\ServerInfo
	 */
	public function clusterEnableServer($serverId)
	{
	    $this->request->setAction(new \ZendServerAPI\Method\ClusterEnableServer($serverId));
	    return $this->request->send();
	}
	
	/**
	 * PHP function for 'RestartPhp' API call
	 *
	 * @access public
	 * @param array $serverIds The ids of the server to restart
	 * @param boolean restart all servers in parallel
	 * @return \ZendServerAPI\DataTypes\ServerInfo
	 */
	public function restartPhp($serverIds = array(), $parallelRestart = false)
	{
	    $this->request->setAction(new \ZendServerAPI\Method\RestartPHP($serverIds, $parallelRestart));
	    return $this->request->send();
	}
	
	/**
	 * PHP function for 'ClusterReconfigureServer' API call
	 *
	 * @access public
	 * @param int $serverId The id of the server to reconfigure
	 * @param boolean restart server
	 * @return \ZendServerAPI\DataTypes\ServerInfo
	 */
	public function clusterReconfigureServer($serverId, $doRestart = false)
	{
	    $this->request->setAction(new \ZendServerAPI\Method\ClusterReconfigureServer($serverId, $doRestart));
	    return $this->request->send();
	}

}

?>