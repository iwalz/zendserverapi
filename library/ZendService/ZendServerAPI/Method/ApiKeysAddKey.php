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
 * <b>The  Method</b>
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
class ApiKeysAddKey extends Method
{
    protected $username = null;
    protected $name = null;
    /**
     * Set the arguments and configures the method
     *
     * @param string $name <p>The name of the key</p>
     * @param string $username <p>Any username supplied for retrieving ACL information (admin/develop/..)</p>
     * @return \ZendService\ZendServerAPI\Method\ApiKeysAddKey
     */
    public function setArgs($name, $username)
    {
        $this->name = $name;
        $this->username = $username;
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
        $this->setFunctionPath('/ZendServer/Api/apiKeysAddKey');
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
        $content = "username=" . $this->username;
        $content .= "&name=" . $this->name;

        return $content;
    }
}
