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
class JobqueueRequeueJob extends Method
{
    protected $limit = null;
    protected $offset = null;
    protected $orderBy = null;
    protected $direction = null;

    /**
     * set arguments for JobqueueJobsList
     *
     * @param
     */
    public function setArgs($limit, $offset, $orderBy, $direction)
    {
        $this->limit = $limit;
        $this->offset = $offset;
        $this->orderBy = $orderBy;
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
        $this->setFunctionPath('/ZendServerManager/Api/jobqueueListRules');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\DumpParser());
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        $link = $this->getFunctionPath();
        $link .= "?limit=" . $this->limit;
        $link .= "&offset=" . $this->offset;
        $link .= "&orderBy=" . $this->orderBy;
        $link .= "&direction=" . $this->direction;

        return $link;
    }
}
