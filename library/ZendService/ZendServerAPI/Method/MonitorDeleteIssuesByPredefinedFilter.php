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
 * <b>The monitorDeleteIssuesByPredefinedFilter Method</b>
 *
 * <pre>Delete monitor issues based on some filtering parameters. Note though, that as this method only marks the
 * issues for deletion, subsequent calls with the same parameters will return the same size of issues deleted
 * rather than expected 0.</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Kevin Papst <kpapst@gmx.net>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class MonitorDeleteIssuesByPredefinedFilter extends Method
{
    /**
     * The filter ID of the issues to be deleted
     * @var string
     */
    protected $filterId = null;
    /**
     * Limit of entries to be deleted.
     * Default is 50.
     * @var int
     */
    protected $limit = 50;
    /**
     * Offset to start with deleteion.
     * Default is 0.
     * @var int
     */
    protected $offset = 0;
    /**
     * Order to use when searching for issues to be deleted.
     * Default is 'date'.
     * @var string
     */
    protected $order = 'date';
    /**
     * Direction to use when searching for issues to be deleted.
     * Default is 'DESC'.
     * @var string
     */
    protected $direction = 'DESC';


    /**
     * Set arguments for MonitorDeleteIssuesByPredefinedFilter
     *
     * Deletes all issues for the given filter id.
     *
     * @param  string $filterId The filter ID
     * @return \ZendService\ZendServerAPI\Method\MonitorDeleteIssuesByPredefinedFilter
     */
    public function setArgs($filterId, $limit = 50, $offset = 0, $order = null, $direction = null)
    {
        $this->filterId = $filterId;
        $this->limit = $limit;
        $this->offset = $offset;
        if ($order !== null && !empty($order)) {
            $this->order = $order;
        }
        if ($direction !== null && !empty($direction)) {
            $this->direction = $direction;
        }

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
        $this->setMethod('POST');
        $this->setFunctionPath('/Api/monitorDeleteIssuesByPredefinedFilter');
        $this->setParser(new \ZendService\ZendServerAPI\Adapter\MonitorDeleteIssues());
    }

    /**
     * Returns the accept header
     *
     * @return string
     */
    public function getAcceptHeader()
    {
        return "application/vnd.zend.serverapi+xml;version=1.3";
    }

    /**ö
     * Get link for the method
     *
     * @return string
     */
    public function getContent()
    {
        $link = "filterId=".$this->filterId;
        $link .= "&limit=".$this->limit;
        $link .= "&offset=".$this->offset;
        $link .= "&order=".$this->order;
        $link .= "&direction=".$this->direction;

        return $link;
    }
}
