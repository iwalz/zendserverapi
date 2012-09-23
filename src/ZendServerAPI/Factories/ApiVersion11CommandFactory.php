<?php
namespace ZendServerAPI\Factories;

class ApiVersion11CommandFactory extends ApiVersion10CommandFactory
{
    public static function factory($name)
    {
        $args = func_get_args();
        array_shift($args);

        switch($name)
        {
            default:
                return call_user_func_array('parent::factory', array_merge(array($name), $args));
        }
    }
}

?>