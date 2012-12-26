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
 * <b>The filterSave Method</b>
 *
 * <pre>Save a filter.</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class FilterSave extends Method
{
    /**
     * The type to filter (issue, job)
     * @var string
     */
    protected $type = null;
    /**
     * Name of filter.
     * @var string
     */
    protected $name = null;
    /**
     * ID of a filter.
     * @var int
     */
    protected $id = null;
    /**
     * Array of parameters to be saved.
     * @var array
     */
    protected $data = array();
    
    /**
     * Set the arguments and configures the method
     * 
     * @var string $type     <p>The type of the filter (job, issue)</p>
     * @var string $name     <p>The name of the filter</p>
     * @var int $id          <p>The ID of the filter</p>
     * @var array $data      <p>Array of parameters to be saved</p>
     * @return \ZendService\ZendServerAPI\Method\FilterGetByType
     */
    public function setArgs($type, $name, $id = null, $data = array())
    {
        $this->type = $type;
        $this->name = $name;
        $this->id = $id;
        $this->data = $data;
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
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServer/Api/filterSave');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\Filter());
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
     * Get post content
     *
     * @return string
     */
    public function getContent()
    {
        $content = "type=" . $this->type;
        $content .= "&name=" . $this->name;
        
        if($this->data !== array())
            $content .= "&data=" . json_encode($this->data);
        
        if($this->id !== null)
            $content .= "&id=" . $this->id;
    
        return $content;
    }
}
