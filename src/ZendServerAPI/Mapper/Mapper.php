<?php
namespace ZendServerAPI\Mapper;

abstract class Mapper
{
    abstract function parse($xml);
}

?>