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
 * <b>The UserAuthenticateSettings Method</b>
 *
 * <pre>Modify current authentication settings, allowing the user to switch between simple and extended
 * authentication and authorization schemes.</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class UserAuthenticateSettings extends Method
{
    /**
     * @var string
     */
    protected $type = null;
    /**
     * @var array
     */
    protected $ldap = array();
    /**
     * @var string
     */
    protected $password = null;
    /**
     * @var string
     */
    protected $confirmNewPassword = null;

    /**
     * Set the arguments and configures the method
     *
     * @param string $type <p>One of : simple, extended</p>
     * @param array  $ldap <p>Array of ldap properties:
     * host: host, ip or location of the active directory
     * port: port part of the URL above
     * encryption:
     * ssl - use SSL to secure communications
     * tls - start TLS to secure communications
     * none - no encryption is used
     * username: directory username, broken to CN and DC parts for use in querying the active directory
     * password: matching password for the above username
     * baseDn: DN broken down to CN and DC parts for using during user authentication</p>
     * @param string $password <p>Current user’s password for authentication</p>
     * @param string $confirmNewPassword <p>Confirmation of new password</p>
     * @return \ZendService\ZendServerAPI\Method\UserAuthenticateSettings
     */
    public function setArgs($type, $password, $confirmNewPassword, $ldap = array())
    {
        $this->type = $type;
        $this->ldap = $ldap;
        $this->password = $password;
        $this->confirmNewPasswort = $confirmNewPassword;
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
        $this->setFunctionPath('/ZendServer/Api/userAuthenticationSettings');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\DumpParser());
    }

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
        $content .= "&password=". $this->password;
        $content .= "&confirmNewPassword=". $this->confirmNewPassword;

        if (isset($this->ldap['host'])) {
            $content .= "&ldap[host]=" . $this->ldap['host'];
        }
        if (isset($this->ldap['port'])) {
            $content .= "&ldap[port]=" . $this->ldap['port'];
        }
        if (isset($this->ldap['encryption'])) {
            $content .= "&ldap[encryption]=" . $this->ldap['encryption'];
        }
        if (isset($this->ldap['username'])) {
            $content .= "&ldap[username]=" . $this->ldap['username'];
        }
        if (isset($this->ldap['password'])) {
            $content .= "&ldap[password]=" . $this->ldap['password'];
        }
        if (isset($this->ldap['baseDn'])) {
            $content .= "&ldap[baseDn]=" . $this->ldap['baseDn'];
        }

        return $content;
    }
}
