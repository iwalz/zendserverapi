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
 * <b>The applicationRollback Method</b>
 *
 * <pre>Rollback an existing application to its previous version.
 * This process is asynchronous, meaning the initial request will
 * start the rollback process and the initial response will show
 * information about the application being rolled back.
 * You must continue checking the application status using the
 * applicationGetStatus method until the process is complete.</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class ApplicationRollback extends Method
{
    /**
     * Application ID to rollback
     * @var int
     */
    private $appId = null;

    /**
     * Set arguments for ApplicationRollback
     *
     * @param int $appId ApplicationId to rollback
     */
    public function setArgs($appId)
    {
        $this->appId = $appId;
        
        $this->configure();
    }

    /**
     * Configures all needed information for the method implementation
     *
     * @return void
     */
    public function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/applicationRollback');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\ApplicationInfo());
    }

    /**
     * Content for POST request
     *
     * @return string
     */
    public function getContent()
    {
        return ("appId=".$this->appId);
    }
}
