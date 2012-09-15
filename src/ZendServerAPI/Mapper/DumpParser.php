<?php
namespace ZendServerAPI\Mapper;

class DumpParser extends \ZendServerAPI\Mapper\Mapper 
{
	/* 
     * @see \ZendServerAPI\Mapper\Mapper::parse()
     */
    function parse ()
    {
        var_dump((string)$this->getResponse()->getBody());
        return $this->getResponse()->getBody();
    }

    
}