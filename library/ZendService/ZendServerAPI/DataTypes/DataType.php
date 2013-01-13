<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright      Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @package        Zend_Service
 */

namespace ZendService\ZendServerAPI\DataTypes;

use Zend\Stdlib\Hydrator\ClassMethods;
use ZendService\ZendServerAPI\PluginInterface;

/**
 * Base DataType implementation.
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
abstract class DataType implements PluginInterface
{

    /**
     * Get an associative array based on the model information
     *
     * @return array
     */
    public function extract ($object = null)
    {
        $hydrator = new ClassMethods(false);
        if($object === null) {
            $retval = $hydrator->extract($this);
        } else {
            $retval = $hydrator->extract($object);
        }

        // Iterate through members to extract recursivly (including arrays)
        foreach ($retval as $key => $value) {
            if (is_array($value) || $value instanceof \Traversable) {
                foreach($value as $subKey => $subValue) {
                    if (is_object($subValue)) {
                        $retval[$key][$subKey] = $this->extract($subValue);
                    }
                }
            }
            if (is_object($value)) {
                $retval[$key] = $this->extract($value);
            }
        }

        return $retval;
    }

}
