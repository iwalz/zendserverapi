<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright      Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @package        Zend_Service
 */
namespace ZendService\ZendServerAPI\Deployment;

use IteratorAggregate;
use Countable;
use ArrayIterator;

/**
 *
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class ParameterList implements IteratorAggregate, Countable
{
    protected $parameters = array();

    public function addParameter(Parameter $parameter)
    {
        $this->parameters[] = $parameter;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->parameters);
    }

    public function count()
    {
        return count($this->parameters);
    }
}
