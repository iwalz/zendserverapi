<?php
namespace ZendServerAPI\DataTypes;

class Step
{
    protected $number = null;
    protected $object = null;
    protected $class = null;
    protected $function = null;
    protected $file = null;
    protected $line = null;

    public function __construct()
    {

    }
    /**
     * @return the $number
     */
    public function getNumber ()
    {
        return $this->number;
    }

    /**
     * @return the $object
     */
    public function getObject ()
    {
        return $this->object;
    }

    /**
     * @return the $class
     */
    public function getClass ()
    {
        return $this->class;
    }

    /**
     * @return the $function
     */
    public function getFunction ()
    {
        return $this->function;
    }

    /**
     * @return the $file
     */
    public function getFile ()
    {
        return $this->file;
    }

    /**
     * @return the $line
     */
    public function getLine ()
    {
        return $this->line;
    }

    /**
     * @param NULL $number
     */
    public function setNumber ($number)
    {
        $this->number = $number;
    }

    /**
     * @param NULL $object
     */
    public function setObject ($object)
    {
        $this->object = $object;
    }

    /**
     * @param NULL $class
     */
    public function setClass ($class)
    {
        $this->class = $class;
    }

    /**
     * @param NULL $function
     */
    public function setFunction ($function)
    {
        $this->function = $function;
    }

    /**
     * @param NULL $file
     */
    public function setFile ($file)
    {
        $this->file = $file;
    }

    /**
     * @param NULL $line
     */
    public function setLine ($line)
    {
        $this->line = $line;
    }

}
