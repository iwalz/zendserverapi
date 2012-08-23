<?php
namespace ZendServerAPI\DataTypes;

class ServerInfo
{
    /**
     * @var Integer
     */
    private $id = null;
    /**
     * @var string
     */
    private $name = null;
    /**
     * @var string
     */
    private $address = null;
    /**
     * @var string
     */
    private $status = null;
    /**
     * @var \ZendServerAPI\DataTypes\MessageList
     */
    private $messageList = null;
    
	/**
     * @return the $id
     */
    public function getId ()
    {
        return $this->id;
    }

	/**
     * @return the $name
     */
    public function getName ()
    {
        return $this->name;
    }

	/**
     * @return the $address
     */
    public function getAddress ()
    {
        return $this->address;
    }

	/**
     * @return the $status
     */
    public function getStatus ()
    {
        return $this->status;
    }

	/**
     * @return the $messageList
     */
    public function getMessageList ()
    {
        return $this->messageList;
    }

	/**
     * @param Integer $id
     */
    public function setId ($id)
    {
        $this->id = (int)$id;
    }

	/**
     * @param string $name
     */
    public function setName ($name)
    {
        $this->name = $name;
    }

	/**
     * @param string $address
     */
    public function setAddress ($address)
    {
        $this->address = $address;
    }

	/**
     * @param string $status
     */
    public function setStatus ($status)
    {
        $this->status = $status;
    }

	/**
     * @param \ZendServerAPI\MessageList $messageList
     */
    public function setMessageList ($messageList)
    {
        $this->messageList = $messageList;
    }

    
}

?>