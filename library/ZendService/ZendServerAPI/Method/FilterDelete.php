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
 * <b>The filterDelete Method</b>
 *
 * <pre>Delete a filter.</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class FilterDelete extends Method
{
    /**
     * Name of filter.
     * @var string
     */
    protected $name = null;
    
    /**
     * Set the arguments and configures the method
     * 
     * @var string $name
     * @return \ZendService\ZendServerAPI\Method\FilterGetByType
     */
    public function setArgs($name)
    {
        $this->name = $name;
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
        $this->setFunctionPath('/ZendServer/Api/filterDelete');
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
        $content = "name=" . $this->name;
        
        return $content;
    }
}
