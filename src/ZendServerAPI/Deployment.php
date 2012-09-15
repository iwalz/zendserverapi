<?php
namespace ZendServerAPI;

class Deployment extends BaseAPI
{

    /**
     * Construct of 'Deployment' section
     *
     * @access public
     * @param string $name
     *            name of the server to connect to
     * @param \ZendServerAPI\Request $request
     *            Request object that should be used
     */
    public function __construct ($name = null, ZendServerAPI\Request $request = null)
    {
        parent::__construct($name);
        
        if ($request !== null)
            $this->request = $request;
    }

    /**
     * Implementation of 'applicationGetStatus' method
     *
     * @access public
     * @param
     *            array Ids of application's
     * @return \ZendServerAPI\DataTypes\ApplicationList
     */
    public function applicationGetStatus (array $applicationIds = array())
    {
        $this->request->setAction(
                new \ZendServerAPI\Method\ApplicationGetStatus($applicationIds));
        return $this->request->send();
    }

    /**
     * Implementation of 'applicationDeploy' method
     *
     * @access public
     * @param
     *            string File object of ZPK file
     * @param
     *            string The baseurl to which the application will be deployed
     * @param
     *            boolean create VHost
     * @param
     *            boolean Deploy the application on the default server
     * @param
     *            string Free text for user defined application identifier
     * @param
     *            boolean ignore errors during staging on some servers
     * @param
     *            array Set values for user parameters defined in package
     * @return \ZendServerAPI\DataTypes\ApplicationInfo
     */
    public function applicationDeploy ($file, $baseUrl, $createVhost = false, 
            $defaultServer = false, $userAppName = null, $igonreFailures = false, 
            $userParams = array())
    {
        $this->request->setAction(
                new \ZendServerAPI\Method\ApplicationDeploy($file, $baseUrl, 
                        $createVhost, $defaultServer, $userAppName, 
                        $igonreFailures, $userParams));
        return $this->request->send();
    }

    /**
     * Implementation of 'applicationUpdate' method
     *
     * @access public
     * @param
     *            Integer The application's ID
     * @param
     *            \SplFileInfo The application's package
     * @param
     *            s boolean Ignore failures during staging on some servers
     * @param
     *            s array Set values for user parameters defined in package
     * @return \ZendServerAPI\DataTypes\ApplicationInfo
     */
    public function applicationUpdate ($appId, SplFileInfo $package, 
            $ignoreFailures = false, array $userParams = array())
    {}

    /**
     * Implementation of 'applicationRemove' method
     *
     * @access public
     * @param id $appId            
     * @return \ZendServerAPI\DataTypes\ApplicationInfo
     */
    public function applicationRemove ($appId)
    {
        $this->request->setAction(
                new \ZendServerAPI\Method\ApplicationRemove($appId));
        return $this->request->send();
    }

    /**
     * Implementation of 'applicationSynchronize' method
     *
     * @access public
     * @param
     *            integer The application's id
     * @param
     *            array Array of server IDs to perform action on
     * @param
     *            boolean Ignore failures during staging on some servers
     * @return \ZendServerAPI\DataTypes\ApplicationList
     */
    public function applicationSynchronize ($appId, array $servers = array(), 
            $ignoreFailures = false)
    {}

    /**
     * Wait for status = OK on $server, check every $interval seconds
     *
     * @param int $applicationId
     *            The application's ID
     * @param int $interval
     *            Seconds to repeat test
     * @return \ZendServerAPI\DataTypes\ApplicationInfo
     */
    public function waitForStableState ($applicationId, $interval = 5)
    {
        $applicationInfo = null;
        $i = 0;
        do {
            sleep($interval);
            
            $applicationList = $this->applicationGetStatus(array($applicationId));
            $applicationInfos = $applicationList->getApplicationInfos();
            $applicationInfo = $applicationInfos[0];

            if($i++ == 5)
                break;
        } while($applicationInfo->getStatus() !== "deployed");
        
        return $applicationInfo;
    }
    
    /**
     * Wait for application not beeing in the list
     *
     * @param int $applicationId
     *            The application's ID
     * @param int $interval
     *            Seconds to repeat test
     * @return boolean
     */
    public function waitForRemoved ($applicationId, $interval = 5)
    {
        $applicationInfo = null;
        $i = 0;
        $retVal = true;
        
        do {
            sleep($interval);
        
            $applicationList = $this->applicationGetStatus(array($applicationId));
            $applicationInfos = $applicationList->getApplicationInfos();
        
            if($i++ == 5)
            {
                $retVal = false;
                break;
            }
        } while($applicationInfos !== array());
        
        return $retVal;
    }
}

?>