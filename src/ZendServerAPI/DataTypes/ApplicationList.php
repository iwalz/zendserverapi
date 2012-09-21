<?php
namespace ZendServerAPI\DataTypes;

class ApplicationList
{
    /**
     * Internal application info storage
     * @var array
     */
    protected $applicationInfos = array();

    /**
     * Add application info object to container
     *
     * @param \ZendServerAPI\DataTypes\ApplicationInfo $applicationInfo
     */
    public function addApplicationInfo(\ZendServerAPI\DataTypes\ApplicationInfo $applicationInfo)
    {
        $this->applicationInfos[] = $applicationInfo;
    }

    /**
     * Get the application info array
     *
     * @return array
     */
    public function getApplicationInfos()
    {
        return $this->applicationInfos;
    }
}
