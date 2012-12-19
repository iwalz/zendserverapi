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
 * A factory, that retrieves commands from the webapi version 1.0.
 * Used for the intruduced Zend Server version 5.1
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class ApiVersion10CommandFactory implements CommandFactory, AbstractFactoryInterface, PluginInterface
{
    /**
     * Internal array with the available commands
     * @var array
     */
    private $availableCommands = null;
    
    /**
     * Constructor. Set's internal default values
     * 
     * @return ApiVersion10CommandFactory
     */
    public function __construct()
    {
        $this->availableCommands = array(
            'clusterGetServerStatus',
            'clusterAddServer',
            'clusterRemoveServer',
            'clusterEnableServer',
            'clusterDisableServer',
            'restartPHP',
            'getSystemInfo',
            'configurationImport',
            'configurationExport'
        );
    }
    
    /**
     * Retrieves the command object and throws an error if
     * the command is not supported via this factory (and the Zend Server/webapi version).
     *
     * @throws \RuntimeException
     * @param  string                            $name
     * @return \ZendService\ZendServerAPI\Method
     */
    public function factory($name)
    {
        $args = func_get_args();
        array_shift($args);

        switch ($name) {
            case 'clusterGetServerStatus':
            case 'clusterAddServer':
            case 'clusterRemoveServer':
            case 'clusterEnableServer':
            case 'clusterDisableServer':
            case 'restartPHP':
            case 'getSystemInfo':
            case 'configurationImport':
            case 'configurationExport':
                $reflect  = new \ReflectionClass("\\ZendService\\ZendServerAPI\\Method\\" . ucfirst($name));
                return $reflect->newInstanceArgs();
                break;
            default:
                throw new \RuntimeException('The method ' . $name . ' is not available');
        }
    }
    
    public function canCreateServiceWithName (
            ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        return in_array($requestedName, $this->availableCommands);
    }

    public function createServiceWithName (
            ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        return self::factory($requestedName);
    }

}
