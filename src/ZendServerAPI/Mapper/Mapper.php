<?php
namespace ZendServerAPI\Mapper;

abstract class Mapper
{
    /**
     * Parse the xml response in object mappings
     * 
     * @param string $xml
     */
    abstract function parse($xml);
}

?>