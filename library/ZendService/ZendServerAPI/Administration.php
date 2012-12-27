<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright      Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @package        Zend_Service
 */

namespace ZendService\ZendServerAPI;

/**
 * <b> Administration Methods</b>
 *
 * The following is a list of methods available for the Administration feature:
 *
 * <ul>
 * <li>The userAuthenticateSettings Method</li>
 * <li>The userSetPassword Method</li>
 * <li>The setPassword Method</li>
 * <li>The apiKeysGetList Method</li>
 * <li>The apiKeysAddKey Method</li>
 * <li>The apiKeyRemove Method</li>
 * <li>The serverValidateLicense Method</li>
 * <li>The aclSetGroups Method</li>
 * <li>The bootstrapSingleServer Method</li>
 * </ul>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class Administration extends BaseAPI
{
    /**
     * <b>The userAuthenticateSettings Method </b>
     *
     * <pre>Modify current authentication settings, allowing the user to switch between simple and extended authentication and authorization schemes.</pre>
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
     * @return \ZendService\ZendServerAPI\DataTypes\AuthenticationType
     */
    public function userAuthenticateSettings($type, $password, $confirmNewPassword, $ldap = array())
    {
        $this->pluginManager->get('request')->setAction($this->pluginManager->get('userAuthenticateSettings')->setArgs($type, $password, $confirmNewPassword, $ldap));

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The userSetPassword Method </b>
     *
     * <pre> Modify a specific user password. This action changes any user password and is an administrative action.
     * Note that a separate action exists for the user to modify his own password and has a lower permission level.</pre>
     *
     * @param string $username            <p>admin (for Administrator)
     * testuser (for Developer)</p>
     * @param string $password            <p>Current password.</p>
     * @param string $newPassword         <p>New password.</p>
     * @param string $confirmNewPassword  <p>Confirmation of new password.</p>
     * @return \ZendService\ZendServerAPI\DataTypes\UserInfo
     */
    public function userSetPassword($username, $password, $newPassword, $confirmNewPassword)
    {
        $this->pluginManager->get('request')->setAction(
            $this->pluginManager->get('userSetPassword')->setArgs(
                $username,
                $password,
                $newPassword,
                $confirmNewPassword
            )
        );

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The setPassword Method </b>
     *
     * <pre>Modify a current user password.</pre>
     *
     * @param string $password            <p>Current password.</p>
     * @param string $newPassword         <p>New password.</p>
     * @param string $confirmNewPassword  <p>Confirmation of new password.</p>
     * @return \ZendService\ZendServerAPI\DataTypes\UserInfo
     */
    public function setPassword($password, $newPassword, $confirmNewPassword)
    {
        $this->pluginManager->get('request')->setAction($this->pluginManager->get('setPassword')->setArgs($password, $newPassword, $confirmNewPassword));

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The apiKeysGetList Method </b>
     *
     * <pre>Get a list of api keys.</pre>
     *
     * @return \ZendService\ZendServerAPI\DataTypes\ApiKeys
     */
    public function apiKeysGetList()
    {
        $this->pluginManager->get('request')->setAction($this->pluginManager->get('apiKeysGetList')->setArgs());

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The apiKeysAddKey Method </b>
     *
     * <pre>Add a WebAPI Key.</pre>
     *
     * @param string $name <p>The name of the key</p>
     * @param string $username <p>Any username supplied for retrieving ACL information (admin/develop/..)</p>
     * @return \ZendService\ZendServerAPI\DataTypes\DebugRequest
     */
    public function apiKeysAddKey($name, $username)
    {
        $this->pluginManager->get('request')->setAction(
            $this->pluginManager->get('apiKeysAddKey')->setArgs($name, $username)
        );

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The apiKeyRemove Method </b>
     *
     * <pre></pre>
     *
     * @return \ZendService\ZendServerAPI\DataTypes\DebugRequest
     */
    public function apiKeyRemove()
    {
        $this->pluginManager->get('request')->setAction($this->pluginManager->get('apiKeyRemove')->setArgs());

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The serverValidateLicense Method </b>
     *
     * <pre></pre>
     *
     * @return \ZendService\ZendServerAPI\DataTypes\DebugRequest
     */
    public function serverValidateLicense()
    {
        $this->pluginManager->get('request')->setAction($this->pluginManager->get('serverValidateLicense')->setArgs());

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The aclSetGroups Method </b>
     *
     * <pre></pre>
     *
     * @return \ZendService\ZendServerAPI\DataTypes\DebugRequest
     */
    public function aclSetGroups()
    {
        $this->pluginManager->get('request')->setAction($this->pluginManager->get('aclSetGroups')->setArgs());

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The  Method </b>
     *
     * <pre></pre>
     *
     * @return \ZendService\ZendServerAPI\DataTypes\DebugRequest
     */
    public function bootstrapSingleServer()
    {
        $this->pluginManager->get('request')->setAction($this->pluginManager->get('bootstrapSingleServer')->setArgs());

        return $this->pluginManager->get('request')->send();
    }
}
