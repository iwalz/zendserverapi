<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright      Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @package        Zend_Service
 */

namespace ZendService\ZendServerAPI\DataTypes;

/**
 * CodeTrace model implementation.
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class CodeTrace extends DataType
{
    /**
     * The trace id
     * @var string
     */
    protected $id = null;
    /**
     * The create date time
     * @var \DateTime
     */
    protected $date = null;
    /**
     * The traced URL
     * @var string
     */
    protected $url = null;
    /**
     * The createdBy Event
     * @var string
     */
    protected $createdBy = null;
    /**
     * File size in bytes
     * @var integer
     */
    protected $fileSize = null;
    /**
     * The application id
     * @var integer
     */
    protected $applicationId = null;

    /**
     * Get the codeTrace id
     *
     * @return string
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * Get the creation timestamp
     *
     * @return \DateTime
     */
    public function getDate ()
    {
        return $this->date;
    }

    /**
     * Get the URL string that created the trace
     *
     * @return string
     */
    public function getUrl ()
    {
        return $this->url;
    }

    /**
     * Get the method of creation
     * (Code Request, Manual Request, Monitor Request)
     *
     * @return string
     */
    public function getCreatedBy ()
    {
        return $this->createdBy;
    }

    /**
     * Get the file size in bytes
     *
     * @return int
     */
    public function getFileSize ()
    {
        return $this->fileSize;
    }

    /**
     * Get the application id
     *
     * @return int
     */
    public function getApplicationId ()
    {
        return $this->applicationId;
    }

    /**
     * Set the codeTrace id
     *
     * @param  string $id
     * @return void
     */
    public function setId ($id)
    {
        $this->id = $id;
    }

    /**
     * Creation timestamp, will end up as a \DateTime
     *
     * @param  \DateTime|int|string $date
     * @throws \RuntimeException
     * @return void
     */
    public function setDate ($date)
    {
        if (is_int($date)) {
            $this->date = new \DateTime();
            $this->date->setTimestamp($date);
        } elseif (is_string($date)) {
            $this->date = new \DateTime();
            $this->date->setTimestamp((int) $date);
        } elseif ($date instanceof \DateTime) {
            $this->date = $date;
        } else {
            throw new \RuntimeException("Invalid data type");
        }
    }

    /**
     * URL string that created the trace
     *
     * @param  string $url
     * @return void
     */
    public function setUrl ($url)
    {
        $this->url = $url;
    }

    /**
     * Set the method of creation (Code Request,
     * Manual Request, Monitor Event)
     *
     * @param  string $createdBy
     * @return void
     */
    public function setCreatedBy ($createdBy)
    {
        $this->createdBy = $createdBy;
    }

    /**
     * Set the file size in bytes
     *
     * @param  float $fileSize
     * @return void
     */
    public function setFileSize ($fileSize)
    {
        $this->fileSize = (float) $fileSize;
    }

    /**
     * Set the application id
     *
     * @param  int  $applicationId
     * @return void
     */
    public function setApplicationId ($applicationId)
    {
        $this->applicationId = (int) $applicationId;
    }

}
