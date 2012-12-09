<?php
namespace ZendService\ZendServerAPI;

use Zend\ServiceManager\ConfigInterface,
    Zend\ServiceManager\ServiceManager;

class ServiceManagerConfig implements ConfigInterface
{
    public function configureServiceManager (ServiceManager $serviceManager)
    {
        $serviceManager->addAbstractFactory('\ZendService\ZendServerAPI\Factories\ApiVersion10CommandFactory');
    }    
}

