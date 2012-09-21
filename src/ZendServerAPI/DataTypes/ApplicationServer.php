<?php
namespace ZendServerAPI\DataTypes;

class ApplicationServer
{
    /**
     * The server ID
     * @var int
     */
    protected $id = null;
    /**
     * The latest version of the application that was identified
     * on the server
     * @var string
     */
    protected $deployedVersion = null;
    /**
     * The deployedVersion's status
     * @see \ZendServerAPI\DataTypes\ApplicationInfo::$status
     * @var string
     */
    protected $status = null;

    /**
     * Get the server's ID
     *
     * @return integer
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * Get the latest deployed Version
     *
     * @return string
     */
    public function getDeployedVersion ()
    {
        return $this->deployedVersion;
    }

    /**
     * Get the application's status
     *
     * @see \ZendServerAPI\DataTypes\ApplicationInfo::getStatus
     * @return string
     */
    public function getStatus ()
    {
        return $this->status;
    }

    /**
     * Set the server's ID
     *
     * @param integer $id
     */
    public function setId ($id)
    {
        $this->id = $id;
    }

    /**
     * Set the latest deployed Version
     *
     * @param string $deployedVersion
     */
    public function setDeployedVersion ($deployedVersion)
    {
        $this->deployedVersion = $deployedVersion;
    }

    /**
     * Set the application's status
     *
     * @see * @see \ZendServerAPI\DataTypes\ApplicationInfo::setStatus
     * @param string $status
     */
    public function setStatus ($status)
    {
        $this->status = $status;
    }

}
