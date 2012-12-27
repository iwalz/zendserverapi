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
     * <b>The  Method </b>
     *
     * <pre></pre>
     *
     * @return \ZendService\ZendServerAPI\DataTypes\DebugRequest
     */
    public function userAuthenticateSettings($type, $password, $confirmNewPassword, $ldap = array())
    {
        $this->pluginManager->get('request')->setAction($this->pluginManager->get('userAuthenticateSettings')->setArgs($type, $password, $confirmNewPassword, $ldap));

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The  Method </b>
     *
     * <pre></pre>
     *
     * @return \ZendService\ZendServerAPI\DataTypes\DebugRequest
     */
    public function userSetPassword()
    {
        $this->pluginManager->get('request')->setAction($this->pluginManager->get('userSetPassword')->setArgs());

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The  Method </b>
     *
     * <pre></pre>
     *
     * @return \ZendService\ZendServerAPI\DataTypes\DebugRequest
     */
    public function setPassword()
    {
        $this->pluginManager->get('request')->setAction($this->pluginManager->get('setPassword')->setArgs());

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The  Method </b>
     *
     * <pre></pre>
     *
     * @return \ZendService\ZendServerAPI\DataTypes\DebugRequest
     */
    public function apiKeysGetList()
    {
        $this->pluginManager->get('request')->setAction($this->pluginManager->get('apiKeysGetList')->setArgs());

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The  Method </b>
     *
     * <pre></pre>
     *
     * @return \ZendService\ZendServerAPI\DataTypes\DebugRequest
     */
    public function apiKeysAddKey()
    {
        $this->pluginManager->get('request')->setAction($this->pluginManager->get('apiKeysAddKey')->setArgs());

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
