<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright      Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @package        Zend_Service
 */
namespace ZendService\ZendServerAPI\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;

class ClassMethodsRecursive extends ClassMethods
{
    public function extract($object)
    {
        if (is_object($object)) {
            $attributes = parent::extract($object);
        }

         // Iterate through members to extract recursivly (including arrays)
        foreach ($attributes as $key => $value) {
            if (is_array($value) || $value instanceof \Traversable) {
                foreach($value as $subKey => $subValue) {
                    if (is_object($subValue)) {
                        $attributes[$key][$subKey] = $this->extract($subValue);
                    }
                }
            }
            if (is_object($value)) {
                $attributes[$key] = $this->extract($value);
            }
        }

        return $attributes;
    }

}

