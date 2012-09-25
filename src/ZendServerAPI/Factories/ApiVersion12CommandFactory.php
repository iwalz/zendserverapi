<?php
namespace ZendServerAPI\Factories;

class ApiVersion12CommandFactory extends ApiVersion11CommandFactory
{
    public function factory($name)
    {
        $args = func_get_args();
        array_shift($args);

        switch ($name) {
            case 'codetracingDisable':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\CodetracingDisable');
                return $reflect->newInstanceArgs($args);
                break;
            case 'codetracingEnable':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\CodetracingEnable');
                return $reflect->newInstanceArgs($args);
                break;
            case 'codetracingIsEnabled':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\CodetracingIsEnabled');
                return $reflect->newInstanceArgs($args);
                break;
            default:
                return call_user_func_array('parent::factory', array_merge(array($name), $args));
        }
    }
}
