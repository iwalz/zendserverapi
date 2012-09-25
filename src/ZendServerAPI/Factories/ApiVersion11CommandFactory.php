<?php
namespace ZendServerAPI\Factories;

class ApiVersion11CommandFactory extends ApiVersion10CommandFactory
{
    public function factory($name)
    {
        $args = func_get_args();
        array_shift($args);

        switch ($name) {
            case 'clusterReconfigureServer':
                return new \ZendServerAPI\Method\ClusterReconfigureServer($args[0]);
                break;
            case 'applicationGetStatus':
                return new \ZendServerAPI\Method\ApplicationGetStatus($args[0]);
                break;
            case 'applicationDeploy':
                return new \ZendServerAPI\Method\ApplicationDeploy($args[0], $args[1]);
                break;
            case 'applicationRemove':
                return new \ZendServerAPI\Method\ApplicationRemove($args[0]);
                break;
            case 'applicationRollback':
                return new \ZendServerAPI\Method\ApplicationRollback($args[0]);
                break;
            case 'applicationSynchronize':
                return new \ZendServerAPI\Method\ApplicationSynchronize($args[0]);
                break;
            case 'applicationUpdate':
                return new \ZendServerAPI\Method\ApplicationUpdate($args[0], $args[1]);
                break;
            default:
                return call_user_func_array('parent::factory', array_merge(array($name), $args));
        }
    }
}
