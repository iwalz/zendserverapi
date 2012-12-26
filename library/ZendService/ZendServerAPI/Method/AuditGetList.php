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
 * <b>The auditGetList Method</b>
 *
 * <pre>Get a list of audit entries.</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class AuditGetList extends Method
{
    /**
     * The type to filter (issue, job)
     * @var string
     */
    protected $limit = null;
    protected $offset = null;
    protected $order = null;
    protected $direction = null;
    protected $filters = array();

    /**
     * Set the arguments and configures the method
     *
     * @var string $type
     * @return \ZendService\ZendServerAPI\Method\FilterGetByType
     */
    public function setArgs($limit, $offset, $order, $direction, $filters)
    {
        $this->limit = $limit;
        $this->offset = $offset;
        $this->order = $order;
        $this->direction = $direction;
        $this->filters = $filters;
        $this->configure();

        return $this;
    }

    /**
     * Configures all needed information for the method implementation
     *
     * @return void
     */
    public function configure()
    {
        $this->setMethod('GET');
        $this->setFunctionPath('/ZendServer/Api/auditGetList');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\AuditMessages());
    }

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
            $link .= ($link == $this->getFunctionPath() ? "?" : "&") . "limit=".$this->limit;
        }
        if ($this->offset) {
            $link .= ($link == $this->getFunctionPath() ? "?" : "&") . "offset=".$this->offset;
        }
        if ($this->order) {
            $link .= ($link == $this->getFunctionPath() ? "?" : "&") . "order=".$this->order;
        }
        if ($this->direction) {
            $link .= ($link == $this->getFunctionPath() ? "?" : "&") . "direction=".$this->direction;
        }

        return $link;
    }
}
