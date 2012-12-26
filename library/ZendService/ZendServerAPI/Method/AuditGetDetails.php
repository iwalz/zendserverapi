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
 * <b>The auditGetDetails Method</b>
 *
 * <pre>Get all details available on a particular audit item.</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class AuditGetDetails extends Method
{
    /**
     * Audit ID to get all details for
     * @var int
     */
    protected $auditId = null;

    /**
     * Set the arguments and configures the method
     *
     * @var int $auditId
     * @return \ZendService\ZendServerAPI\Method\FilterGetByType
     */
    public function setArgs($auditId)
    {
        $this->auditId = $auditId;
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
        $this->setFunctionPath('/ZendServer/Api/auditGetDetails');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\AuditMessageDetails());
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

        $link .= "?auditId=".$this->auditId;

        return $link;
    }
}
