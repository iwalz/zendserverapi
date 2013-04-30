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
 * <b>The aclSetGroups Method</b>
 *
 * <pre></pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class AclSetGroups extends Method
{
    protected $roleGroups = array();
    protected $appGroups = array();

    /**
     * Set the arguments and configures the method
     *
     * @return \ZendService\ZendServerAPI\Method\
     */
    public function setArgs($roleGroups, $appGroups = array())
    {
        $this->roleGroups = $roleGroups;
        $this->appGroups = $appGroups;
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
        $this->setFunctionPath('/Api/aclSetGroups');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\DumpParser());
    }

    public function getAcceptHeader()
    {
        return "application/vnd.zend.serverapi+xml;version=1.3";
    }

    /**
     * Get post body content
     *
     * @return string
     */
    public function getContent()
    {
        $content = $this->buildParameterArray("role_groups", $this->roleGroups);
        $content .= "&" . $this->buildParameterArray("app_groups", $this->appGroups);

        return $content;
    }
}
