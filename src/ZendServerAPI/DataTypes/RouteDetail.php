<?php
namespace ZendServerAPI\DataTypes;

class RouteDetail
{
    protected $key = null;
    protected $value = null;

    public function __construct()
    {

    }
    /**
     * @return the $key
     */
    public function getKey ()
    {
        return $this->key;
    }

    /**
     * @return the $value
     */
    public function getValue ()
    {
        return $this->value;
    }

    /**
     * @param NULL $key
     */
    public function setKey ($key)
    {
        $this->key = $key;
    }

    /**
     * @param NULL $value
     */
    public function setValue ($value)
    {
        $this->value = $value;
    }

}
