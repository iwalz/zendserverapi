<?php
namespace ZendServerAPI\Factories;

use ZendServerAPI\Method\ClusterReconfigureServer;

use ZendServerAPI\Method\ApplicationUpdate;

use ZendServerAPI\Method\ApplicationSynchronize;

use ZendServerAPI\Method\ApplicationRollback;

use ZendServerAPI\Method\ApplicationRemove;

use ZendServerAPI\Method\ApplicationDeploy;

use ZendServerAPI\Method\ApplicationGetStatus;

class ApiVersion11CommandFactory extends ApiVersion10CommandFactory
{
    public static function factory($name)
    {
        $args = func_get_args();
        array_shift($args);

        switch($name)
        {
            case 'clusterReconfigureServer':
                return new ClusterReconfigureServer($args[0]);
                break;
            case 'applicationGetStatus':
                return new ApplicationGetStatus($args[0]);
                break;
            case 'applicationDeploy':
                return new ApplicationDeploy($args[0], $args[1]);
                break;
            case 'applicationRemove':
                return new ApplicationRemove($args[0]);
                break;                
            case 'applicationRollback':
                return new ApplicationRollback($args[0]);
                break;
            case 'applicationSynchronize':
                return new ApplicationSynchronize($args[0]);
                break;
            case 'applicationUpdate':
                return new ApplicationUpdate($args[0], $args[1]);
                break;
            default:
                return call_user_func_array('parent::factory', array_merge(array($name), $args));
        }
    }
}

?>