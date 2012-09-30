<?php
namespace ZendServerAPI\DataTypes;

class CodeTrace
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
     * @var int
     */
    protected $fileSize = null;
    /**
     * The application id
     * @var integer
     */
    protected $applicationId = null;
    
    public function __construct()
    {

    }
    
	/**
     * @return the $id
     */
    public function getId ()
    {
        return $this->id;
    }

	/**
     * @return the $date
     */
    public function getDate ()
    {
        return $this->date;
    }

	/**
     * @return the $url
     */
    public function getUrl ()
    {
        return $this->url;
    }

	/**
     * @return the $createdBy
     */
    public function getCreatedBy ()
    {
        return $this->createdBy;
    }

	/**
     * @return the $fileSize
     */
    public function getFileSize ()
    {
        return $this->fileSize;
    }

	/**
     * @return the $applicationId
     */
    public function getApplicationId ()
    {
        return $this->applicationId;
    }

	/**
     * @param string $id
     */
    public function setId ($id)
    {
        $this->id = $id;
    }

	/**
     * @param DateTime $date
     */
    public function setDate ($date)
    {
        $this->date = $date;
    }

	/**
     * @param string $url
     */
    public function setUrl ($url)
    {
        $this->url = $url;
    }

	/**
     * @param string $createdBy
     */
    public function setCreatedBy ($createdBy)
    {
        $this->createdBy = $createdBy;
    }

	/**
     * @param number $fileSize
     */
    public function setFileSize ($fileSize)
    {
        $this->fileSize = $fileSize;
    }

	/**
     * @param number $applicationId
     */
    public function setApplicationId ($applicationId)
    {
        $this->applicationId = $applicationId;
    }

}
