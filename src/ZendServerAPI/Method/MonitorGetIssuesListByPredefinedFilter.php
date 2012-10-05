<?php
namespace ZendServerAPI\Method;

class MonitorGetIssuesListByPredefinedFilter extends \ZendServerAPI\Method
{
    /**
     * The predefined filter's id. Can be the filter's “name” or the
     * actual identifier randomly created by the system. This
     * parameter is case-sensitive
     * @var string
     */
    protected $filterId = null;
    /**
     * The number of rows to retrieve. Default lists all events up
     * to an arbitrary limit set by the system
     * @var Integer
     */
    protected $limit = null;
    /**
     * A paging offset to begin the issues list from. Default is 0
     * @var Integer
     */
    protected $offset = null;
    /**
     * Column identifier for sorting the result set (id, repeats,
     * date, eventType, fullUrl, severity, status). Default is date
     * @var string
     */
    protected $order = null;
    /**
     * Sorting direction: Ascending or Descending. Default is
     * Descending
     * @var string
     */
    protected $direction = null;

    /**
     * Constructor of method MonitorGetIssuesListByPredefinedFilter
     *
     * Retrieve a list of monitor issues according to a preset filter identifier.
     * The filter identifier is shared with the UI's predefined filters.
     * This WebAPI method may also accept ordering details and paging limits.
     * The response is a list of issue elements with their general details and event-groups identifiers.
     *
     * @param  string                                                       $filterId  The predefined filter's id
     * @param  Integer|null                                                 $limit     The number of rows to retrieve
     * @param  Integer|null                                                 $offset    A paging offset to begin the issues list from
     * @param  string|null                                                  $order     Column identifier for sorting the result set
     * @param  string|null                                                  $direction Sorting direction: Ascending or Descending
     * @return \ZendServerAPI\Method\MonitorGetIssuesListByPredefinedFilter
     */
    public function __construct($filterId, $limit = null, $offset = null, $order = null, $direction = null)
    {
        $this->filterId = $filterId;
        $this->limit = $limit;
        $this->offset = $offset;
        $this->order = $order;
        $this->direction = $direction;
        parent::__construct();
    }

    /**
     * @see \ZendServerAPI\Method::configure()
     */
    public function configure ()
    {
        $this->setMethod('GET');
        $this->setFunctionPath('/ZendServerManager/Api/monitorIssuesListByPredefinedFilter');
        $this->setParser(new \ZendServerAPI\Adapter\DumpParser());
    }

    public function getAcceptHeader()
    {
        return "application/vnd.zend.serverapi+xml;version=1.1";
    }

    /**
     * @see \ZendServerAPI\Method::getLink()
     */
    public function getLink()
    {
        $link = $this->getFunctionPath();
        $link .= "?filterId=".$this->filterId;
        $link .= "&limit=".$this->limit;
        $link .= "&order=".$this->order;
        $link .= "&offset=".$this->offset;
        $link .= "&direction=".$this->direction;

        return $link;
    }
}
