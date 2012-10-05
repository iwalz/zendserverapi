<?php
namespace ZendServerAPI\Method;

class CodetracingDelete extends \ZendServerAPI\Method
{
    /**
     * Trace file ID to delete
     * @var integer
     */
    private $id = null;

    /**
     * Constructor for codetracingDelete method
     *
     * @param integer $id Trace file ID
     */
    public function __construct($id)
    {
        $this->id = $id;
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
        $this->setFunctionPath('/ZendServerManager/Api/codetracingDelete');
        $this->setParser(new \ZendServerAPI\Adapter\Codetrace());
    }

    /**
     * Content for POST request
     *
     * @return string
     */
    public function getContent()
    {
        return ("traceFile=".$this->id);
    }
}
