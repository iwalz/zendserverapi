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
 * <b>The codetracingIsEnabled Method</b>
 *
 * <pre>Check if the directives zend_codetracing.always_dump and
 * zend_codetracing.trace_enabled are set, and if the code-tracing component
 * is active.</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class CodetracingIsEnabled extends Method
{
    /**
     * Set arguments for CodetracingIsEnabled
     */
    public function setArgs()
    {
        $this->configure();
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
        $this->setFunctionPath('/ZendServerManager/Api/codetracingIsEnabled');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\CodetracingStatus());
    }
}
