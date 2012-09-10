<?php
namespace ZendServerAPI\Mapper;

class ApplicationList extends Mapper
{
    /**
     * @see \ZendServerAPI\Mapper\Mapper::parse()
     */
    public function parse ($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();
        
        $xml = simplexml_load_string($xml);
        
    }
}

?>