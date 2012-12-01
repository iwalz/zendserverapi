<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link 		http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright 	Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license 	http://framework.zend.com/license/new-bsd New BSD License
 * @package 	Zend_Service
 */

namespace ZendService\ZendServerAPI\DataTypes;

/**
 * IssueList model implementation.
 *
 * @license	http://framework.zend.com/license/new-bsd New BSD License
 * @link		http://github.com/zendframework/zf2 for the canonical source repository
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @category	Zend
 * @package	Zend_Service
 * @subpackage	ZendServerAPI
 */
class LicenseInfo extends DataType
{
    /**
     * The licensing status, which can be one of the following:
     * notRequired - This edition does not require this license type.
     * OK - The server/cluster is licensed and working.
     * invalid - The license is invalid.
     * expired - The license has expired.
     * serverLimitExceeded - The Zend Server Cluster Manager server limit has been exceeded.
     * @var string
     */
    private $status = null;
    /**
     * The license order number, which is empty if there is no license.
     * @var string
     */
    private $orderNumber = null;
    /**
     * The license expiration date, which is empty if there is no license (timestamp)
     * @var int
     */
    private $validUntil = null;
    /**
     * For a Zend Server Cluster Manager license, this is the
     * number of servers allowed by the license. For a license
     * other than Zend Server Cluster Manager, the value is always 0.
     * @var int
     */
    private $serverLimit = null;

    /**
     * Get the licensing status, which can be one of the following:
     * notRequired - This edition does not require this license type.
     * OK - The server/cluster is licensed and working.
     * invalid - The license is invalid.
     * expired - The license has expired.
     * serverLimitExceeded - The Zend Server Cluster Manager server limit has been exceeded.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the license order number, which is empty if there is no license.
     *
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * Get the license expiration date, which is empty if there is no license (timestamp)
     *
     * @return int
     */
    public function getValidUntil()
    {
        return $this->validUntil;
    }

    /**
     * Get the server limit - for a Zend Server Cluster Manager license, this is the
     * number of servers allowed by the license. For a license other than
     * Zend Server Cluster Manager, the value is always 0.
     *
     * @return int
     */
    public function getServerLimit()
    {
        return $this->serverLimit;
    }

    /**
     * Set the licensing status, which can be one of the following:
     * notRequired - This edition does not require this license type.
     * OK - The server/cluster is licensed and working.
     * invalid - The license is invalid.
     * expired - The license has expired.
     * serverLimitExceeded - The Zend Server Cluster Manager server limit has been exceeded.
     *
     * @param  string $status
     * @return void
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Set the license order number, which is empty if there is no license.
     *
     * @param  string $orderNumber
     * @return void
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;
    }

    /**
     * Set the license expiration date, which is empty if there is no license (timestamp)
     *
     * @param  int  $validUntil
     * @return void
     */
    public function setValidUntil($validUntil)
    {
        $this->validUntil = (int) $validUntil;
    }

    /**
     * Set the server limit - For a Zend Server Cluster Manager license, this is the
     * number of servers allowed by the license. For a license
     * other than Zend Server Cluster Manager, the value is always 0.
     *
     * @param  int  $serverLimit
     * @return void
     */
    public function setServerLimit($serverLimit)
    {
        $this->serverLimit = (int) $serverLimit;
    }
}
