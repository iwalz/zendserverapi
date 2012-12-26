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
 * AuditMessages collection model implementation.
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class AuditMessages extends DataType implements \Countable, \IteratorAggregate
{
    /**
     * Internal auditMessage storage
     * @var array
     */
    protected $auditMessages = array();

    /**
     * Add auditMessage to container
     *
     * @param  \ZendService\ZendServerAPI\DataTypes\AuditMessage $auditMessage
     * @return void
     */
    public function addAuditMessage(\ZendService\ZendServerAPI\DataTypes\AuditMessage $auditMessage)
    {
        $this->auditMessages[] = $auditMessage;
    }

    /**
     * Get the auditMessage array
     *
     * @return array
     */
    public function getAuditMessages()
    {
        return $this->auditMessages;
    }

    /**
     * Implementation for traversable
     *
     * @see IteratorAggregate::getIterator()
     * @return \ArrayIterator
     */
    public function getIterator ()
    {
        return new \ArrayIterator($this->auditMessages);
    }

    /**
     * Implementation for countable
     *
     * @see Countable::count()
     * @return int
     */
    public function count ()
    {
        return count($this->getIterator());
    }

}
