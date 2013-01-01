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
 * <b>The jobqueueJobsList Method</b>
 *
 * <pre>Retrieve and display a list of jobs</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class JobqueueJobsList extends Method
{
    protected $limit = null;
    protected $offset = null;
    protected $orderBy = null;
    protected $direction = null;
    protected $filter = null;
    /**
     * set arguments for JobqueueJobsList
     *
     * @param
     */
    public function setArgs($limit, $offset, $orderBy, $direction, $filter)
    {
        $this->limit = $limit;
        $this->offset = $offset;
        $this->orderBy = $orderBy;
        $this->direction = $direction;
        $this->filter = $filter;
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
        $this->setFunctionPath('/ZendServer/Api/jobqueueJobsList');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\DumpParser());
    }

    /**
     * Returns the correct accept header for a specific version
     *
     * @see \ZendService\ZendServerAPI\Method\Method::getAcceptHeader()
     * @return string
     */
    public function getAcceptHeader()
    {
        return "application/vnd.zend.serverapi+xml;version=1.3";
    }

    /**
     * Get link for the method
     *
     * @return string
     */
    public function getLink()
    {
        $link = $this->getFunctionPath();
        if ($this->limit) {
            $link .= ($link == $this->getFunctionPath() ? "?" : "&") . "limit=" . $this->limit;
        }
        if ($this->offset) {
            $link .= ($link == $this->getFunctionPath() ? "?" : "&") . "offset=" . $this->offset;
        }
        if ($this->orderBy) {
            $link .= ($link == $this->getFunctionPath() ? "?" : "&") . "orderBy=" . $this->orderBy;
        }
        if ($this->direction) {
            $link .= ($link == $this->getFunctionPath() ? "?" : "&") . "direction=" . $this->direction;
        }
        if ($this->filter) {
            $link .= ($link == $this->getFunctionPath() ? "?" : "&") . $this->buildParameterArray('filter', $this->filter);
        }

        return $link;
    }
}
