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
     * Hydrator to transform datatype
     * @var \Zend\Stdlib\Hydrator\HydratorInterface
     */
    protected $hydrator = null;

    /**
     * Get the hydrator to transform datatype
     *
     * @return \Zend\Stdlib\Hydrator\HydratorInterface
     */
    public function getHydrator()
    {
        return $this->hydrator;
    }

    /**
     * Set the hydrator to transform datatype
     *
     * @param \Zend\Stdlib\Hydrator\HydratorInterface $hydrator
     */
    public function setHydrator(\Zend\Stdlib\Hydrator\HydratorInterface $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    /**
     * Get an associative array based on the model information
     *
     * @return array
     */
    public function extract ()
    {
        return $this->hydrator->extract($this);
    }

}
