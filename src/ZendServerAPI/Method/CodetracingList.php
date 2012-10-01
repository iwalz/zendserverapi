<?php
namespace ZendServerAPI\Method;

class CodetracingList extends \ZendServerAPI\Method
{
    protected $applicationIds = null;
    protected $limit = null;
    protected $offset = null;
    protected $orderBy = null;
    protected $direction = null;

    /**
     * Constructor for CodetracingList method
     */
    public function __construct($applicationIds = array(), $limit = null, $offset = null, $orderBy = null, $direction = null)
    {
        parent::__construct();

        $this->applicationIds = $applicationIds;
        $this->limit = $limit;
        $this->offset = $offset;
        $this->orderBy = $orderBy;
        $this->direction = $direction;
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
        $this->setFunctionPath('/ZendServerManager/Api/codetracingList');
        $this->setParser(new \ZendServerAPI\Mapper\CodetracingList());
    }

    public function getLink()
    {
        $link = parent::getLink();

        $link .= '?offset='.$this->offset;
        $link .= '&limit='.$this->limit;
        $link .= '&orderBy='.$this->orderBy;
        $link .= '&'.$this->buildParameterArray('applicationIds', $this->applicationIds);
        $link .= '&direction='.$this->direction;

        return $link;
    }
}
