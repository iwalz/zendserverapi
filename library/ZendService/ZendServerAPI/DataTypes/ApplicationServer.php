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
 * ApplicationServer model implementation.
 *
 * @license	    http://framework.zend.com/license/new-bsd New BSD License
 * @link		http://github.com/zendframework/zf2 for the canonical source repository
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @category	Zend
 * @package	    Zend_Service
 * @subpackage	ZendServerAPI
 */
class ApplicationServer extends DataType
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
     * @var string
     */
    protected $status = null;

    /**
     * Get the server's ID
     *
     * @return int
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
     * @see \ZendService\ZendServerAPI\DataTypes\ApplicationInfo::getStatus
     * @return string
     */
    public function getStatus ()
    {
        return $this->status;
    }

    /**
     * Set the server's ID
     *
     * @param  int  $id
     * @return void
     */
    public function setId ($id)
    {
        $this->id = (int) $id;
    }

    /**
     * Set the latest deployed Version
     *
     * @param  string $deployedVersion
     * @return void
     */
    public function setDeployedVersion ($deployedVersion)
    {
        $this->deployedVersion = $deployedVersion;
    }

    /**
     * Set the application's status
     *
     * @param  string $status
     * @return void
     */
    public function setStatus ($status)
    {
        $this->status = $status;
    }

}
