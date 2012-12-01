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
 * <b>The codetracingDisable Method</b>
 *
 * <pre>Disable the code-tracing directive two directives necessary
 * for creating tracing dumps, this action does not disable the
 * code-tracing component.</pre>
 *
 * @license	http://framework.zend.com/license/new-bsd New BSD License
 * @link		http://github.com/zendframework/zf2 for the canonical source repository
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @category	Zend
 * @package	Zend_Service
 * @subpackage	ZendServerAPI
 */
class CodetracingDisable extends Method
{
    /**
     * Restart directly after disable
     * @var boolean
     */
    private $restartNow = null;

    /**
     * Constructor for CodetracingDisable method
     *
     * @param boolean $restartNow restart directly after disable
     */
    public function __construct($restartNow = true)
    {
        $this->restartNow = $restartNow;
        parent::__construct();
    }

    /**
     * Returns the codetracing accept header
     *
     * @access public
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
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/codetracingDisable');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\CodetracingStatus());
    }

    /**
     * Content for POST request
     *
     * @return string
     */
    public function getContent()
    {
        return ("restartNow=".($this->restartNow === true ? 'TRUE' : 'FALSE'));
    }
}
