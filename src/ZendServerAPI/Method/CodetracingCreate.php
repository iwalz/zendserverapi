<?php
namespace ZendServerAPI\Method;

class CodetracingCreate extends \ZendServerAPI\Method
{
    /**
     * URL encoded URL to trace
     * @var string
     */
    private $url = null;

    /**
     * Constructor for codetracingCreate method
     *
     * @param string $url URL to trace
     */
    public function __construct($url)
    {
        $this->url = $url;
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
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/codetracingCreate');
        $this->setParser(new \ZendServerAPI\Mapper\DumpParser());
    }

    /**
     * Content for POST request
     *
     * @return string
     */
    public function getContent()
    {
        return ("url=".urlencode($this->url));
    }
}
