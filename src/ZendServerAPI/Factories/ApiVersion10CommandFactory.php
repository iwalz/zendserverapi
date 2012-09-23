<?php
namespace ZendServerAPI\Factories;

class ApiVersion10CommandFactory implements CommandFactory
{
    public static function factory($name)
    {
        $args = func_get_args();
        array_shift($args);
        
        switch($name)
        {
            case 'clusterGetServerStatus':
                return new \ZendServerAPI\Method\ClusterGetServerStatus($args[0]);
                break;
            case 'clusterAddServer':
                return new \ZendServerAPI\Method\ClusterAddServer($args[0], $args[1], $args[2]);
                break;
            case 'clusterRemoveServer':
                return new \ZendServerAPI\Method\ClusterRemoveServer($args[0], $args[1]);
                break;
            case 'clusterEnableServer':
                return new \ZendServerAPI\Method\ClusterEnableServer($args[0]);
                break;
            case 'clusterDisableServer':
                return new \ZendServerAPI\Method\ClusterDisableServer($args[0]);
                break;
            case 'clusterReconfigureServer':
                return new \ZendServerAPI\Method\ClusterReconfigureServer($args[0]);
                break;
            case 'restartPHP':
                return new \ZendServerAPI\Method\RestartPHP($args[0], $args[1]);
                break;
            case 'getSystemInfo':
                return new \ZendServerAPI\Method\GetSystemInfo();
                break;
            default:
                throw new \RuntimeException('The method ' . $name . ' is not available');
        }
    }
}

?>