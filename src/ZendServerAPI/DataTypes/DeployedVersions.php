<?php
namespace ZendServerAPI\DataTypes;

class DeployedVersions
{
    /**
     * Version number
     * @var string
     */
    protected $version = null;

    /**
     * Set the version number
     * @param string $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * Get the version number
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }
}
