<?php
namespace ZendServerAPI\DataTypes;

class MessageList {
    private $info = null;
    private $warning = null;
    private $error = null;
    
    public function __construct($xmlData = null)
    {
        if($xmlData !== null)
        {
            $xml = simplexml_load_string($xmlData);
            
            $this->info = (string)$xml->info;
            $this->warning = (string)$xml->warning;
            $this->error = (string)$xml->error;
        }
    }
    
	/**
     * @return the $info
     */
    public function getInfo ()
    {
        return $this->info;
    }

	/**
     * @return the $warning
     */
    public function getWarning ()
    {
        return $this->warning;
    }

	/**
     * @return the $error
     */
    public function getError ()
    {
        return $this->error;
    }

	/**
     * @param NULL $info
     */
    public function setInfo ($info)
    {
        $this->info = $info;
    }

	/**
     * @param NULL $warning
     */
    public function setWarning ($warning)
    {
        $this->warning = $warning;
    }

	/**
     * @param NULL $error
     */
    public function setError ($error)
    {
        $this->error = $error;
    }

}