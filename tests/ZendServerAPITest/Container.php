<?php
namespace ZendServerAPITest;

class Container
{
    protected static $config = null;
    
    public static function setConfig($config)
    {
        self::$config = $config;
    }
    
    public static function getConfig()
    {
        return self::$config;
    }
}