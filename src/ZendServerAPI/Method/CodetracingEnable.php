<?php
namespace ZendServerAPI\Method;

class CodetracingEnable extends \ZendServerAPI\Method
{
    /**
     * Restart directly after enable
     * @var boolean
     */
    private $restartNow = null;

    /**
     * Constructor for CodetracingDisable method
     *
     * @param boolean $restartNow restart directly after enable
     */
    public function __construct($restartNow = true)
    {
        $this->restartNow = $restartNow;
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
        $this->setFunctionPath('/ZendServerManager/Api/codetracingEnable');
        $this->setParser(new \ZendServerAPI\Adapter\CodetracingStatus());
    }

    /**
     * Content for POST request
     *
     * @return string
     */
    public function getContent()
    {
        return ("restartNow=".($this->restartNow === true ? 'TRUE' : 'FALSE'));
    }
}
