<?php
namespace ZendServerAPI\Adapter;

class DumpParser extends \ZendServerAPI\Adapter\Adapter
{
    /*
     * @see \ZendServerAPI\Adapter\Adapter::parse()
     */
    public function parse ()
    {
        var_dump((string) $this->getResponse()->getBody());

        return $this->getResponse()->getBody();
    }

}
