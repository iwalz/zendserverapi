<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link 		http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright 	Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license 	http://framework.zend.com/license/new-bsd New BSD License
 * @package 	Zend_Service
 */

namespace ZendService\ZendServerAPI\Method;

/**
 * <b>The codetracingList Method</b>
 *
 * <pre>Retrieve a list of code-tracing files available for download
 * using codetracingDownloadTraceFile.</pre>
 *
 * @license	    http://framework.zend.com/license/new-bsd New BSD License
 * @link		http://github.com/zendframework/zf2 for the canonical source repository
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @category	Zend
 * @package	    Zend_Service
 * @subpackage	ZendServerAPI
 */
class CodetracingList extends Method
{
    /**
     * List of application IDs. If specified, code-tracing
     * entries will be returned for these applications only.
     * Default: all applications
     *
     * @var array
     */
    protected $applicationIds = null;
    /**
     * Row limit to retrieve, defaults to value defined in
     * zend-user-user.ini
     *
     * @var int
     */
    protected $limit = null;
    /**
     * The page offset to be displayed, defaults to 0
     *
     * @var int
     */
    protected $offset = null;
    /**
     * Column to sort the result by (Id, Date, Url, CreatedBy,
     * Filesize), defaults to Date
     *
     * @var string
     */
    protected $orderBy = null;
    /**
     * Sorting direction , defaults to Desc
     *
     * @var string
     */
    protected $direction = null;

    /**
     * Constructor for CodetracingList method
     *
     * @param array  $applicationIds Application ID
     * @param int    $limit          Limit to retrieve
     * @param int    $offset         Page offset
     * @param string $orderBy        Column to sort
     * @param string $direction      ASC or DESC
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
     * @return string
     */
    public function getAcceptHeader()
    {
        return "application/vnd.zend.serverapi+xml;version=1.2";
    }

    /**
     * Configures all needed information for the method implementation
     *
     * @return void
     */
    public function configure ()
    {
        $this->setMethod('GET');
        $this->setFunctionPath('/ZendServerManager/Api/codetracingList');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\CodetracingList());
    }

    /**
     * Get link for the method
     *
     * @return string
     */
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
