<?php
namespace ZendServerAPI\Mapper;

class DumpParser extends \ZendServerAPI\Mapper\Mapper 
{
	/* 
     * @see \ZendServerAPI\Mapper\Mapper::parse()
     */
    function parse ()
    {
        return $this->getResponse()->getBody();
    }

    
}