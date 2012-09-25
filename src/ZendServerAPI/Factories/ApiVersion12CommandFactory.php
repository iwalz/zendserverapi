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
                return new \ZendServerAPI\Method\CodetracingDisable($args[0]);
                break;
            case 'codetracingEnable':
                return new \ZendServerAPI\Method\CodetracingEnable($args[0]);
                break;
            case 'codetracingIsEnabled':
                return new \ZendServerAPI\Method\CodetracingIsEnabled();
                break;
            default:
                return call_user_func_array('parent::factory', array_merge(array($name), $args));
        }
    }
}
