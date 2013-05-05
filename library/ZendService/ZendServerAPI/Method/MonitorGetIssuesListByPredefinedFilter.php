<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright      Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @package        Zend_Service
 */

namespace ZendService\ZendServerAPI\Method;

/**
 * <b>The monitorGetIssuesListByPredefinedFilter Method</b>
 *
 * <pre>Retrieve a list of monitor issues according to a preset filter identifier.
 * The filter identifier is shared with the UI's predefined filters.
 * This WebAPI method may also accept ordering details and paging limits.
 *
 * The response is a list of issue elements with their general details and event-groups identifiers.</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class MonitorGetIssuesListByPredefinedFilter extends Method implements ZS6LinkBreakInterface
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
     * Sorting direction: ASC or DESC. Default is DESC
     * @var string
     */
    protected $direction = null;

    /**
     * Set arguments MonitorGetIssuesListByPredefinedFilter
     *
     * Retrieve a list of monitor issues according to a preset filter identifier.
     * The filter identifier is shared with the UI's predefined filters.
     * This WebAPI method may also accept ordering details and paging limits.
     * The response is a list of issue elements with their general details and event-groups identifiers.
     *
     * @param  string                                                                   $filterId  The predefined filter's id
     * @param  Integer|null                                                             $limit     The number of rows to retrieve
     * @param  Integer|null                                                             $offset    A paging offset to begin the issues list from
     * @param  string|null                                                              $order     Column identifier for sorting the result set
     * @param  string|null                                                              $direction Sorting direction: Ascending or Descending
     * @return \ZendService\ZendServerAPI\Method\MonitorGetIssuesListByPredefinedFilter
     */
    public function setArgs($filterId, $limit = null, $offset = null, $order = null, $direction = null)
    {
        $this->filterId = $filterId;
        $this->limit = $limit;
        $this->offset = $offset;
        $this->order = $order;
        $this->direction = $direction;

        $this->configure();

        return $this;
    }

    /**
     * Configures all needed information for the method implementation
     *
     * @return void
     */
    public function configure ()
    {
        $this->setMethod('GET');
        $this->setFunctionPath('/Api/monitorGetIssuesListPredefinedFilter');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\IssueList());
    }

    /**
     * Returns the accept header
     *
     * @return string
     */
    public function getAcceptHeader()
    {
        return "application/vnd.zend.serverapi+xml;version=1.2";
    }

    /**
     * Set the ZS6 Version of the link
     */
    public function enableZS6Link()
    {
        $this->setFunctionPath('/Api/monitorGetIssuesByPredefinedFilter');
    }

    /**
     * Get link for the method
     *
     * @return string
     */
    public function getLink()
    {
        $link = $this->getFunctionPath();
        $link .= "?filterId=".urlencode($this->filterId);
        if (!is_null($this->limit)) {
            $link .= "&limit=".$this->limit;
        }
        if (!is_null($this->order)) {
            $link .= "&order=".$this->order;
        }
        if (!is_null($this->offset)) {
            $link .= "&offset=".$this->offset;
        }
        if (!is_null($this->direction)) {
            $link .= "&direction=".$this->direction;
        }

        return $link;
    }
}
