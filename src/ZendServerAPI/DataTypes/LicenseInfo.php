<?php
namespace ZendServerAPI\DataTypes;

class LicenseInfo
{
    private $status = null;
    private $orderNumber = null;
    private $validUntil = null;
    private $serverLimit = null;

    /**
     * @return the $status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return the $orderNumber
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * @return the $validUntil
     */
    public function getValidUntil()
    {
        return $this->validUntil;
    }

    /**
     * @return the $serverLimit
     */
    public function getServerLimit()
    {
        return $this->serverLimit;
    }

    /**
     * @param NULL $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param NULL $orderNumber
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;
    }

    /**
     * @param NULL $validUntil
     */
    public function setValidUntil($validUntil)
    {
        $this->validUntil = $validUntil;
    }

    /**
     * @param NULL $serverLimit
     */
    public function setServerLimit($serverLimit)
    {
        $this->serverLimit = $serverLimit;
    }
}
