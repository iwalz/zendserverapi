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
     * <b>The apiKeysRemove Method </b>
     *
     * <pre>Remove an api key</pre>
     *
     * @return \ZendService\ZendServerAPI\DataTypes\DebugRequest
     */
    public function apiKeysRemove($ids)
    {
        $this->pluginManager->get('request')->setAction($this->pluginManager->get('apiKeysRemove')->setArgs($ids));

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The serverValidateLicense Method </b>
     *
     * <pre>Validate a Zend Server license.</pre>
     *
     * @param string $licenseName <p>The name of the license</p>
     * @param string $licenseValue <p>The value of the license</p>
     * @return \ZendService\ZendServerAPI\DataTypes\DebugRequest
     */
    public function serverValidateLicense($licenseName, $licenseValue)
    {
        $this->pluginManager->get('request')->setAction(
            $this->pluginManager->get('serverValidateLicense')->setArgs($licenseName, $licenseValue)
        );

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The serverValidateLicense Method </b>
     *
     * <pre>Validate a Zend Server license.</pre>
     *
     * @param string $licenseName <p>The name of the license</p>
     * @param string $licenseValue <p>The value of the license</p>
     * @return \ZendService\ZendServerAPI\DataTypes\DebugRequest
     */
    public function serverStoreLicense($licenseName, $licenseValue)
    {
        $this->pluginManager->get('request')->setAction(
            $this->pluginManager->get('serverStoreLicense')->setArgs($licenseName, $licenseValue)
        );

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The aclSetGroups Method </b>
     *
     * <pre>Store a set of group mappings for resolving user roles during authentication.
     * These groups correspond to roles within the system or to applications that implicitly grant the
     * developerLimited role to the user.</pre>
     *
     * @param array $roleGroups <p>An associative list of role names and their corresponding group.</p>
     * @param array $appGroups <p>An associative list of application IDs (numbers) and their corresponding group.</p>
     * @return \ZendService\ZendServerAPI\DataTypes\DebugRequest
     */
    public function aclSetGroups($roleGroups, $appGroups = array())
    {
        $this->pluginManager->get('request')->setAction(
            $this->pluginManager->get('aclSetGroups')->setArgs($roleGroups, $appGroups)
        );

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The bootstrapSingleServer Method </b>
     *
     * <pre>Bootstrap a server for standalone usage in production or development environment.
     * This action is designed to give an automated process the option to bootstrap a server with particular settings.
     * Note that once a server has been bootstrapped, it may not be added passively into a cluster using
     * clusterAddServer. It may still join a cluster using a direct WebAPI -serverAddToCluster, or a UI call.
     * This WebAPI action is explicitly accessible without a WebAPI Key, but only during the bootstrap stage.
     * Unlike the UI bootstrap/launching process, this bootstrap action does not restart Zend Server nor perform any
     * authentication. A WebAPI key with administrative permissions is created as part of the bootstrap process so
     * that you may immediately continue working. It is up to the user to decide what to do with this key once the
     * bootstrap is completed.
     * Read a certain number of log lines from the end of the file log. If serverId is passed,
     * then the request will be performed against that cluster member, otherwise it is performed locally.</pre>
     *
     * @param string $adminPassword <p>The new administrator password to store for authentication</p>
     * @param string $orderNumber <p>License order number to store in the server’s configuration.
     * This license can be obtained from zend.com</p>
     * @param string $licenseKey <p>License key to store in the server’s configuration. T
     * his license can be obtained from zend.com</p>
     * @param bool $acceptEula <p>Must be set to true to accept ZS6’s EULA</p>
     * @param bool $production <p>Bootstrap this server using the factory “production” usage profile.
     * Default value: true</p>
     * @param string $applicationUrl <p>The default application URL to use when displaying and handling
     * deployed application URLs in the UI. Default: empty</p>
     * @param string $adminEmail <p>The default Email to use when sending notifications about events,
     * audit entries and other features</p>
     * @param string $developerPassword <p>The new developer user password to be stored for authentication.
     * If no password is supplied, the developer user will not be created</p>
     * @return \ZendService\ZendServerAPI\DataTypes\DebugRequest
     */
    public function bootstrapSingleServer(
        $adminPassword,
        $orderNumber,
        $licenseKey,
        $acceptEula,
        $production = null,
        $applicationUrl = null,
        $adminEmail = null,
        $developerPassword = null
    )
    {
        $this->pluginManager->get('request')->setAction(
            $this->pluginManager->get('bootstrapSingleServer')->setArgs(
                $adminPassword,
                $orderNumber,
                $licenseKey,
                $acceptEula,
                $production,
                $applicationUrl,
                $adminEmail,
                $developerPassword
            )
        );

        return $this->pluginManager->get('request')->send();
    }
}
