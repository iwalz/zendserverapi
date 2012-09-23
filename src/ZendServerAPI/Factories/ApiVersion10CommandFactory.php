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
            case 'clusterAddServer':
                return new \ZendServerAPI\Method\ClusterAddServer($args[0], $args[1], $args[2]);
                break;
            default:
                ;
        }
    }
}

?>