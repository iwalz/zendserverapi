<?php

namespace ZendServerAPI;

class Deployment extends BaseAPI 
{
    /**
     * Construct of 'Deployment' section
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
	 * Implementation of 'applicationGetStatus' method
	 * 
	 * @access public
	 * @param array Ids of application's
	 * @return \ZendServerAPI\DataTypes\ApplicationList
	 */
	public function applicationGetStatus(array $applicationIds = array())
	{
	    
	}
	
	/**
	 * Implementation of 'applicationDeploy' method
	 * 
	 * @access public
	 * @param \SplFileInfo File object of ZPK file
	 * @param string The baseurl to which the application will be deployed
	 * @param boolean create VHost
	 * @param boolean Deploy the application on the default server
	 * @param string Free text for user defined application identifier
	 * @param boolean ignore errors during staging on some servers
	 * @param array Set values for user parameters defined in package
	 * @return \ZendServerAPI\DataTypes\ApplicationInfo
	 */
	public function applicationDeploy(
	        \SplFileInfo $file, 
	        $baseUrl, 
	        $createVhost = false, 
	        $defaultServer = false, 
	        $userAppName = null, 
	        $igonreFailures = false, 
	        $userParams = array())
	{
	    
	}
	
	/**
	 * Implementation of 'applicationUpdate' method
	 * 
	 * @access public
	 * @param Integer The application's ID
	 * @param \SplFileInfo The application's package
	 * @params boolean Ignore failures during staging on some servers
	 * @params array Set values for user parameters defined in package
	 * @return \ZendServerAPI\DataTypes\ApplicationInfo
	 */
	public function applicationUpdate(
	        $appId, 
	        \SplFileInfo $package, 
	        $ignoreFailures = false, 
	        array $userParams = array())
	{
	    
	}
	
	/**
	 * Implementation of 'applicationRemove' method
	 * 
	 * @access public
	 * @param id $appId
	 * @return \ZendServerAPI\DataTypes\ApplicationInfo
	 */
	public function applicationRemove($appId)
	{
	    
	}
	
	/**
	 * Implementation of 'applicationSynchronize' method
	 * 
	 * @access public
	 * @param integer The application's id
	 * @param array Array of server IDs to perform action on
	 * @param boolean Ignore failures during staging on some servers
	 * @return \ZendServerAPI\DataTypes\ApplicationList
	 */
	public function applicationSynchronize($appId, array $servers = array(), $ignoreFailures = false)
	{
	    
	}
}

?>