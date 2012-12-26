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
 * <b>The applicationRemove Method</b>
 *
 * <pre>This method allows you to remove an existing application.
 * This process is asynchronous, meaning the initial request will start
 * the removal process and the initial response will show information about the
 * application being removed. However, the removal process will proceed after the
 * response is returned. You must continue checking the application status using the
 * applicationGetStatus method until the removal process is complete.
 * Once applicationGetStatus contains no information about the application,
 * it has been completely removed</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class ApplicationRemove extends Method
{
    /**
     * ApplicationId to remove
     * @var int
     */
    private $applicationId = null;

    /**
     * Set arguments for ApplicationRemove
     *
     * @param int $applicationId ApplicationId to remove
     */
    public function setArgs($applicationId)
    {
        $this->applicationId = $applicationId;

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
        $this->setFunctionPath('/ZendServerManager/Api/applicationRemove');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\ApplicationInfo());
    }

    /**
     * Content for POST request
     *
     * @return string
     */
    public function getContent()
    {
        return ("appId=".$this->applicationId);
    }
}
