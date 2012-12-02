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
abstract class DataType
{

    /**
     * Get an associative array based on the model information
     *
     * @return array
     */
    public function getArray ()
    {
        $returnArray = array();

        // Get members from parent class
        $classVars = get_class_vars(get_called_class());

        // Iterate through members to generate key => value pairs
        foreach ($classVars as $key => $value) {
            $value = $this->$key;

            // If value is an array
            if (is_array($value)) {
                // Iterate through them and call that function recursivly if DataType
                foreach ($value as $subKey => $single) {
                    if ($single instanceof DataType) {
                        $subKey = lcfirst(
                                str_replace("ZendService\\ZendServerAPI\\DataTypes\\", "",
                                        get_class($single)));
                        $subValue = $single->getArray();
                        $returnArray[$subKey][] = $subValue;
                    // If regular value, add to the array
                    } else {
                        $returnArray[$subKey][] = $single;
                    }
                }
            // Value is not array
            } else {
                // and value is DataType
                if ($value instanceof DataType) {
                    $subKey = lcfirst(
                            str_replace("ZendService\\ZendServerAPI\\DataTypes\\", "",
                                    get_class($value)));
                    // Call recursion again
                    $subValue = $value->getArray();
                    $returnArray[$key] = $subValue;
                // Otherwise simply add
                } else {
                    $returnArray[$key] = $value;
                }
            }
        }

        return $returnArray;
    }

}
