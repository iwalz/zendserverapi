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
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\ClusterReconfigureServer');
                return $reflect->newInstanceArgs($args);
                break;
            case 'applicationGetStatus':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\ApplicationGetStatus');
                return $reflect->newInstanceArgs($args);
                break;
            case 'applicationDeploy':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\ApplicationDeploy');
                return $reflect->newInstanceArgs($args);
                break;
            case 'applicationRemove':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\ApplicationRemove');
                return $reflect->newInstanceArgs($args);
                break;
            case 'applicationRollback':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\ApplicationRollback');
                return $reflect->newInstanceArgs($args);
                break;
            case 'applicationSynchronize':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\ApplicationSynchronize');
                return $reflect->newInstanceArgs($args);
                break;
            case 'applicationUpdate':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\ApplicationUpdate');
                return $reflect->newInstanceArgs($args);
                break;
            default:
                return call_user_func_array('parent::factory', array_merge(array($name), $args));
        }
    }
}
