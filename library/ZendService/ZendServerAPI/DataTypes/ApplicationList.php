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
 * ApplicationList model implementation.
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class ApplicationList extends DataType implements \Countable, \IteratorAggregate
{
    /**
     * Internal application info storage
     * @var array
     */
    protected $applicationInfos = array();

    /**
     * Add application info object to container
     *
     * @param  \ZendService\ZendServerAPI\DataTypes\ApplicationInfo $applicationInfo
     * @return void
     */
    public function addApplicationInfo(\ZendService\ZendServerAPI\DataTypes\ApplicationInfo $applicationInfo)
    {
        $this->applicationInfos[] = $applicationInfo;
    }

    /**
     * Get the application info array
     *
     * @return array
     */
    public function getApplicationInfos()
    {
        return $this->applicationInfos;
    }

    /**
     * Implementation for traversable
     *
     * @see IteratorAggregate::getIterator()
     * @return \ArrayIterator
     */
    public function getIterator ()
    {
        return new \ArrayIterator($this->applicationInfos);
    }

    /**
     * Returns the ApplicationInfo by a given name
     *
     * @param  string    $applicationName
     * @return \ZendService\ZendServerAPI\DataTypes\ApplicationInfo|false
     */
    public function getApplicationInfoByName($applicationName)
    {
        foreach ($this->applicationInfos as $applicationInfo) {
            if ($applicationInfo->getAppName() == $applicationName) {

                return $applicationInfo;
            }
        }

        return false;
    }

    /**
     * Returns the ApplicationInfo by a given user app name
     *
     * @param  string    $applicationName
     * @return \ZendService\ZendServerAPI\DataTypes\ApplicationInfo|false
     */
    public function getApplicationInfoByUserAppName($applicationName)
    {
        foreach ($this->applicationInfos as $applicationInfo) {
            if ($applicationInfo->getUserAppName() == $applicationName) {

                return $applicationInfo;
            }
        }

        return false;
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
