<?php
namespace ZendServerAPI\DataTypes;

class SystemInfo
{
	private $xml = null;
	private $status = null;
	private $edition = null;
	private $zendServerVersion = null;
	private $supportedApiVersions = null;	
	private $phpVersion = null;
	private $operatingSystem = null;
	private $deploymentVersion = null;
	private $serverLincenseInfo = null;
	private $managerLicenseInfo = null;
	private $messageList = null;
	
	public function __construct($xml)
	{
	    $this->xml = simplexml_load_string($xml);
	
	    $this->status = (string)$this->xml->responseData->systemInfo->status;
	    $this->edition = (string)$this->xml->responseData->systemInfo->edition;
	    $this->zendServerVersion = (string)$this->xml->responseData->systemInfo->zendServerVersion;
	    $this->supportedApiVersions = (string)trim($this->xml->responseData->systemInfo->supportedApiVersions);
	    $this->phpVersion = (string)$this->xml->responseData->systemInfo->phpVersion;
	    $this->operatingSystem = (string)$this->xml->responseData->systemInfo->operatingSystem;
	    $this->serverLincenseInfo = new LicenseInfo($this->xml->responseData->systemInfo->serverLicenseInfo->asXml());
	    $this->managerLicenseInfo = new LicenseInfo($this->xml->responseData->systemInfo->managerLicenseInfo->asXml());
	    $this->messageList = new MessageList($this->xml->responseData->systemInfo->messageList->asXml());
	}
	
	/**
     * @return the $xml
     */
    public function getXml ()
    {
        return $this->xml;
    }

	/**
     * @return the $status
     */
    public function getStatus ()
    {
        return $this->status;
    }

	/**
     * @return the $edition
     */
    public function getEdition ()
    {
        return $this->edition;
    }

	/**
     * @return the $zendServerVersion
     */
    public function getZendServerVersion ()
    {
        return $this->zendServerVersion;
    }

	/**
     * @return the $supportedApiVersions
     */
    public function getSupportedApiVersions ()
    {
        return $this->supportedApiVersions;
    }

	/**
     * @return the $phpVersion
     */
    public function getPhpVersion ()
    {
        return $this->phpVersion;
    }

	/**
     * @return the $operatingSystem
     */
    public function getOperatingSystem ()
    {
        return $this->operatingSystem;
    }

	/**
     * @return the $deploymentVersion
     */
    public function getDeploymentVersion ()
    {
        return $this->deploymentVersion;
    }

	/**
     * @return the $serverLincenseInfo
     */
    public function getServerLincenseInfo ()
    {
        return $this->serverLincenseInfo;
    }

	/**
     * @return the $managerLicenseInfo
     */
    public function getManagerLicenseInfo ()
    {
        return $this->managerLicenseInfo;
    }

	/**
     * @return the $messageList
     */
    public function getMessageList ()
    {
        return $this->messageList;
    }

	/**
     * @param NULL $xml
     */
    public function setXml ($xml)
    {
        $this->xml = $xml;
    }

	/**
     * @param NULL $status
     */
    public function setStatus ($status)
    {
        $this->status = $status;
    }

	/**
     * @param NULL $edition
     */
    public function setEdition ($edition)
    {
        $this->edition = $edition;
    }

	/**
     * @param NULL $zendServerVersion
     */
    public function setZendServerVersion ($zendServerVersion)
    {
        $this->zendServerVersion = $zendServerVersion;
    }

	/**
     * @param NULL $supportedApiVersions
     */
    public function setSupportedApiVersions ($supportedApiVersions)
    {
        $this->supportedApiVersions = $supportedApiVersions;
    }

	/**
     * @param NULL $phpVersion
     */
    public function setPhpVersion ($phpVersion)
    {
        $this->phpVersion = $phpVersion;
    }

	/**
     * @param NULL $operatingSystem
     */
    public function setOperatingSystem ($operatingSystem)
    {
        $this->operatingSystem = $operatingSystem;
    }

	/**
     * @param NULL $deploymentVersion
     */
    public function setDeploymentVersion ($deploymentVersion)
    {
        $this->deploymentVersion = $deploymentVersion;
    }

	/**
     * @param NULL $serverLincenseInfo
     */
    public function setServerLincenseInfo ($serverLincenseInfo)
    {
        $this->serverLincenseInfo = $serverLincenseInfo;
    }

	/**
     * @param NULL $managerLicenseInfo
     */
    public function setManagerLicenseInfo ($managerLicenseInfo)
    {
        $this->managerLicenseInfo = $managerLicenseInfo;
    }

	/**
     * @param NULL $messageList
     */
    public function setMessageList ($messageList)
    {
        $this->messageList = $messageList;
    }
	
}