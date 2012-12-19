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
 * A factory, that retrieves commands from the webapi version 1.2.
 * Used for the Zend Server version 5.6. Can also handle the commands from
 * 1.1 and 1.0
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class ApiVersion12CommandFactory implements CommandFactory, AbstractFactoryInterface, PluginInterface
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
            'codetracingDisable',
            'codetracingEnable',
            'codetracingIsEnabled',
            'codetracingCreate',
            'codetracingDelete',
            'codetracingList',
            'codetracingDownloadTraceFile',
            'monitorGetRequestSummary',
            'monitorGetIssuesListByPredefinedFilter',
            'monitorGetIssuesDetails',
            'monitorGetEventGroupDetails',
            'monitorChangeIssueStatus',
            'monitorExportIssueByEventsGroup',
            'studioStartDebug',
            'studioStartProfile'
        );
    }
    
    /**
     * Retrieves the command object and throws an error if
     * the command is not supported via this factory (and the Zend Server/webapi version).
     * Will take care of the commands from the previous factories
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
            case 'codetracingDisable':
            case 'codetracingEnable':
            case 'codetracingIsEnabled':
            case 'codetracingCreate':
            case 'codetracingDelete':
            case 'codetracingList':
            case 'codetracingDownloadTraceFile':
            case 'monitorGetRequestSummary':
            case 'monitorGetIssuesListByPredefinedFilter':
            case 'monitorGetIssuesDetails':
            case 'monitorGetEventGroupDetails':
            case 'monitorChangeIssueStatus':
            case 'monitorExportIssueByEventsGroup':
            case 'studioStartDebug':
            case 'studioStartProfile':
                $reflect  = new \ReflectionClass("\\ZendService\\ZendServerAPI\\Method\\" . ucfirst($name));

                return $reflect->newInstanceArgs();
                break;

        }
    }
    
    /**
     * Check if the factory can create an instance by the given name
     * 
     * @see \Zend\ServiceManager\AbstractFactoryInterface::canCreateServiceWithName()
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     * @param string $name The real name
     * @param string $requestedName The requested name (alias)
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
     * @param string $name The real name
     * @param string $requestedName The requested name (alias)
     */
    public function createServiceWithName (
            ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        return self::factory($requestedName);
    }
}
