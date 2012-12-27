<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright      Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @package        Zend_Service
 */

namespace ZendService\ZendServerAPI\Factories;

use Zend\ServiceManager\AbstractFactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface;
use ZendService\ZendServerAPI\PluginInterface;

/**
 * A factory, that retrieves commands from the webapi version 1.3.
 * Used for the Zend Server version 6.0. Can also handle the commands from
 * 1.2, 1.1 and 1.0
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class ApiVersion13CommandFactory implements CommandFactory, AbstractFactoryInterface, PluginInterface
{
    /**
     * Internal array with the available commands
     * @var array
     */
    private $availableCommands = null;

    /**
     * Constructor. Set's internal default values
     *
     * @return ApiVersion12CommandFactory
     */
    public function __construct()
    {
        $this->availableCommands = array(
            'filterGetByType',
            'filterSave',
            'filterDelete',
            'auditGetList',
            'auditGetDetails',
            'auditSetSettings',
            'userAuthenticateSettings',
            'userSetPassword',
            'setPassword',
            'apiKeysGetList',
            'apiKeysAddKey',
            'apiKeyRemove',
            'serverValidateLicense',
            'aclSetGroups',
            'bootstrapSingleServer'
        );
    }

    /**
     * Retrieves the command object and throws an error if
     * the command is not supported via this factory (and the Zend Server/webapi version).
     * Will take care of the commands from the previous factories
     *
     * @throws \RuntimeException
     * @param  string                            $name
     * @return \ZendService\ZendServerAPI\Method\Method
     */
    public function factory($name)
    {
        $args = func_get_args();
        array_shift($args);

        if (in_array($name, $this->availableCommands)) {
            $reflect  = new \ReflectionClass("\\ZendService\\ZendServerAPI\\Method\\" . ucfirst($name));

            return $reflect->newInstanceArgs();
        }
    }

    /**
     * Check if the factory can create an instance by the given name
     *
     * @see \Zend\ServiceManager\AbstractFactoryInterface::canCreateServiceWithName()
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     * @param string                                       $name           The real name
     * @param string                                       $requestedName  The requested name (alias)
     */
    public function canCreateServiceWithName (
            ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        return in_array($requestedName, $this->availableCommands);
    }

    /**
     * Create an instance by the given name
     *
     * @see \Zend\ServiceManager\AbstractFactoryInterface::canCreateServiceWithName()
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     * @param string                                       $name           The real name
     * @param string                                       $requestedName  The requested name (alias)
     */
    public function createServiceWithName (
            ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        return self::factory($requestedName);
    }
}
