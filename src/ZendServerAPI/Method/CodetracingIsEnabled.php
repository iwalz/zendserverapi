<?php
namespace ZendServerAPI\Method;

class CodetracingIsEnabled extends \ZendServerAPI\Method
{
    /**
     * Constructor for CodetracingIsEnabled method
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Returns the codetracing accept header
     *
     * @access public
     * @return string
     */
    public function getAcceptHeader()
    {
        return "application/vnd.zend.serverapi+xml;version=1.2";
    }
    
    /**
     * @see \ZendServerAPI\Method::configure()
     */
    public function configure ()
    {
        $this->setMethod('GET');
        $this->setFunctionPath('/ZendServerManager/Api/codetracingIsEnabled');
        $this->setParser(new \ZendServerAPI\Mapper\DumpParser());
    }
}
