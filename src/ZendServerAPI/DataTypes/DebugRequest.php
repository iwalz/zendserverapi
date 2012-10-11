<?php
namespace ZendServerAPI\DataTypes;

class DebugRequest
{
    protected $success = null;
    protected $message = null;
    
	/**
     * @return the $success
     */
    public function getSuccess ()
    {
        return $this->success;
    }

	/**
     * @return the $message
     */
    public function getMessage ()
    {
        return $this->message;
    }

	/**
     * @param NULL $success
     */
    public function setSuccess ($success)
    {
        $this->success = $success;
    }

	/**
     * @param NULL $message
     */
    public function setMessage ($message)
    {
        $this->message = $message;
    }

}

?>